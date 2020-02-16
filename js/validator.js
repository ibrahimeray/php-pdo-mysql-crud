$(document).ready(function () {

    tinymce.init({selector: 'textarea'});

    $('#einloggen').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            benutzername: {
                validators: {
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: ' '
                    }
                }
            }
        }
    });

    $('#jobs-erstellen').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            titel: {
                validators: {
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            beschreibung: {
                validators: {
                    notEmpty: {
                        message: ' '
                    }
                }
            }
        }
    });


    $('#register').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            vorname: {
                validators: {
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            nachname: {
                validators: {
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            geburtsdatum: {

                excluded: false,
                validators: {
                    notEmpty: {
                        message: 'Bitte Geben Sie ein Datum'
                    },
                    date: {
                        format: 'DD-MM-YYYY',
                        message: 'Richtige DD-MM-YYYY'
                    }
                }
            }
            ,
            benutzername: {
                validators: {
                    notEmpty: {
                        message: ' '
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: ' '
                    }
                }
            }
        }
    });
});