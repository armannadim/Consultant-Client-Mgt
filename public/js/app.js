/* 
 * Initial version of this class has been created, modified and published by Aseq A Arman Nadim. 
 * For any sugestion, update, request, advice feel free to contact armannadim@msn.com
 * 
 * Developer: Aseq A Arman Nadim
 * Email: armannadim@msn.com
 * Web: www.armannadim.com
 */


$(function() {
    $('.client_dd').selectize({
        sortField: 'text'
    });
    $('.problem_dd').selectize({
        sortField: 'text',
        create: true
    });
    $('#select-country').selectize();
    
    $("#datetimepicker1").on("dp.change", function(e) {
        $.ajax({
            url: "getVisitsOfDay/" + e.date + "",
            type: "POST",
            success: function(results) {
                //alert(results);
                $("#visit_list").html(results);
                /*$("#uid" + userid).html(results.uid);
                $("#moved" + userid).html(results.moved);
                $("#percentmoved" + userid).html(results.percentmoved);
                $("#avgspeed" + userid).html(results.avgspeed);
                $("#eta" + userid).html(results.eta);*/
            }
        });

    });
    /*    $('#password').keyup(function(e) {
     var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
     var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
     var enoughRegex = new RegExp("(?=.{6,}).*", "g");
     if (false == enoughRegex.test($(this).val())) {
     $('#passstrength').removeClass();
     $('#passstrength').addClass('control-label');
     $('#passstrength').html('More Characters');
     } else if (strongRegex.test($(this).val())) {
     $('#passstrength').removeClass();
     $('#passstrength').addClass('ok passstrength_strong control-label');
     $('#passstrength').html('Strong!');
     } else if (mediumRegex.test($(this).val())) {
     $('#passstrength').removeClass();
     $('#passstrength').addClass('alert passstrength_medium control-label');
     $('#passstrength').html('Medium!');
     } else {
     $('#passstrength').removeClass();
     $('#passstrength').addClass('error control-label');
     $('#passstrength').html('Weak!');
     }
     return true;
     });*/

    $('#password-confirmation').keyup(function(e) {
        if ($(this).val() === $('#password').val()) {
            $('.pw_val_ok').removeClass('hide');
            $('.pw_val_ko').addClass('hide');
        } else {
            $('.pw_val_ko').removeClass('hide');
            $('.pw_val_ok').addClass('hide');
        }
    });

//called when key is pressed in textbox
    $("#contact_number").keypress(function(e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            $("#err_contact").html("Numbers Only").show();
            return false;
        } else {
            $("#err_contact").fadeOut();
        }
    }
    );
});

/*
---

name: StrongPass.js

description: checks password strength of a string

authors: Dimitar Christoff

license: MIT-style license.

version: 1.0.3

requires:
- Core/String
- Core/Element
- Core/DOMEvent
- Core/Class
- Core/Array

provides: StrongPass

...
*/
var path = window.location.pathname;
if (path.match('/ccm/addstaff')) {
    (function() {
        'use strict';

        var StrongPass = new Class({
            Implements: [Options, Events],
            options: {
                minChar: 6, // too short while less than this

                passIndex: 2, // Weak

                // output verdicts, colours and bar %
                label: 'Password strength: ',
                verdicts: [
                    'Too Short',
                    'Very weak',
                    'Weak',
                    'Good',
                    'Strong',
                    'Very strong'
                ],
                colors: [
                    '#ccc',
                    '#500',
                    '#800',
                    '#f60',
                    '#050',
                    '#0f0'
                ],
                width: [
                    '0%',
                    '10%',
                    '30%',
                    '60%',
                    '80%',
                    '100%'
                ],
                // tweak scores here
                scores: [
                    10,
                    15,
                    25,
                    45
                ],
                // when in banned list, verdict is:
                bannedPass: 'Not allowed',
                // styles
                passStrengthZen: 'div.pass-container',
                passbarClassZen: 'div.pass-bar', // css controls

                passbarHintZen: 'div.pass-hint',
                // output
                render: true, // it can just report for your own implementation

                injectTarget: null,
                injectPlacement: 'after'
            },
            bannedPasswords: [
                // see study here: http://smrt.io/JlNfrH
                '123456',
                '12345',
                '123456789',
                'password',
                'iloveyou',
                'princess',
                'rockyou',
                '1234567',
                '12345678',
                'abc123',
                'nicole',
                'daniel',
                'babygirl',
                'monkey',
                'jessica',
                'lovely',
                'michael',
                'ashley',
                '654321',
                'qwerty',
                'password1',
                'welcome',
                'welcome1',
                'password2',
                'password01',
                'password3',
                'p@ssw0rd',
                'passw0rd',
                'password4',
                'password123',
                'summer09',
                'password6',
                'password7',
                'password9',
                'password8',
                'welcome2',
                'welcome01',
                'winter12',
                'spring2012',
                'summer12',
                'summer2012'
            ],
            /**
             * @constructor
             * @param {DOMElement} element Base element to attach to
             * @param {Object} options* Options to merge in / attach events from
             * @fires StrongPass#ready
             * @returns SrongPass
             */
            initialize: function(element, options) {
                this.setOptions(options);
                this.element = document.id(element);
                this.options.render && this.createBox();
                this.attachEvents();
                this.fireEvent('ready');
            },
            /**
             * @description Attaches events and saves a reference
             * @returns {StrongPass}
             */
            attachEvents: function() {
                // only attach events once so freshen
                this.eventObj && this.element.removeEvents(this.eventObj);
                this.element.addEvents(this.eventObj = {
                    keyup: this.runPassword.bind(this)
                });

                return this;
            },
            /**
             * @description Attaches pass elements.
             * @returns {StrongPass}
             */
            createBox: function() {
                //todo: should be templated
                var width = this.element.getSize().x,
                        o = this.options;

                this.stbox = new Element(o.passStrengthZen, {
                    styles: {
                        width: width
                    }
                });

                this.stdbar = new Element(o.passbarClassZen, {
                    styles: {
                        width: width - 2
                    }
                }).inject(this.stbox);

                this.txtbox = new Element(o.passbarHintZen).inject(this.stbox);
                this.stbox.inject((document.id(o.injectTarget) || this.element), o.injectPlacement);

                return this;
            },
            /**
             * @description Runs a password check on the keyup event
             * @param {Object} event*
             * @param {String} password* Optionally pass a string or go to element getter
             * @fires StrongPass#fail StrongPass#pass
             * @returns {StrongPass}
             */
            runPassword: function(event, password) {
                password = password || this.element.get('value');

                var score = this.checkPassword(password),
                        index = 0,
                        o = this.options,
                        s = Array.clone(o.scores),
                        verdict;

                if (Array.indexOf(this.bannedPasswords, password.toLowerCase()) !== -1) {
                    this.fireEvent('banned', password);
                    verdict = o.bannedPass;
                }
                else {
                    if (score < 0 && score > -199) {
                        index = 0;
                    }
                    else {
                        s.push(score);
                        s.sort(function(a, b) {
                            return a - b;
                        });
                        index = s.indexOf(score) + 1;
                    }

                    verdict = o.verdicts[index] || o.verdicts.getLast();
                }

                if (o.render) {
                    this.txtbox.set('text', [o.label, verdict].join(''));
                    this.stdbar.setStyles({
                        width: o.width[index] || o.width.getLast(),
                        background: o.colors[index] || o.colors.getLast()
                    });
                }

                /**
                 * @event StrongPass#fail,StrongPass#pass
                 */
                return this.fireEvent(['fail', 'pass'][+(this.passed = o.verdicts.indexOf(verdict) >= o.passIndex)], [index, verdict, password]);
            },
            /**
             * @type {Array}
             * @description The collection of regex checks and how much they affect the scoring
             */
            checks: [
                /* alphaLower */ {
                    re: /[a-z]/,
                    score: 1
                },
                /* alphaUpper */ {
                    re: /[A-Z]/,
                    score: 5
                },
                /* mixture of upper and lowercase */ {
                    re: /([a-z].*[A-Z])|([A-Z].*[a-z])/,
                    score: 2
                },
                /* threeNumbers */ {
                    re: /(.*[0-9].*[0-9].*[0-9])/,
                    score: 7
                },
                /* special chars */ {
                    re: /.[!@#$%^&*?_~]/,
                    score: 5
                },
                /* multiple special chars */ {
                    re: /(.*[!@#$%^&*?_~].*[!@#$%^&*?_~])/,
                    score: 7
                },
                /* all together now, does it look nice? */ {
                    re: /([a-zA-Z0-9].*[!@#$%^&*?_~])|([!@#$%^&*?_~].*[a-zA-Z0-9])/,
                    score: 3
                },
                /* password of a single char sucks */ {
                    re: /(.)\1+$/,
                    score: 2
                }
            ],
            checkPassword: function(pass) {
                var score = 0,
                        minChar = this.options.minChar,
                        len = pass.length,
                        diff = len - minChar;

                (diff < 0 && (score -= 100)) || (diff >= 5 && (score += 18)) || (diff >= 3 && (score += 12)) || (diff === 2 && (score += 6));

                Array.each(this.checks, function(check) {
                    pass.match(check.re) && (score += check.score);
                });

                // bonus for length per char
                score && (score += len);
                return score;
            }
        });

        if (typeof define === 'function' && define.amd) {
            // return an AMD module
            define(function() {
                return StrongPass;
            });
        }
        else {
            // exports to global object
            this.StrongPass = StrongPass;
        }

        // change to any object / ns
    }.call(this));

    var passwordChecker = new StrongPass("password", {
        render: true,
        onPass: function(score, verdict) {
            console.log('pass', score, verdict)

        },
        onFail: function(score, verdict) {
            console.log('fail', score, verdict);

        }
    });

}