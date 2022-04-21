$(document).ready(function() {
    if($('#client_phone').length) {
        $('#client_phone').inputmask('+7 (999) 999-99-99');
    }

    $('#support_href').click(function(e) {
        ym(56070517, 'reachGoal', 'open_phone');
    });
});

const steps = $('.quiz__form-step');
const nextStep = $('.js-next');
const prevStep = $('.js-prev');
const percentIndicator = $('.quiz__footer-progress-bar-item');
const percent = $('.quiz__footer-progress-text');
let percentNumb = $('.quiz__footer-progress-text span');
let stepCounter = 0;
let stepPercent = 0;


const clickNextStep = function (evt) {
    evt.preventDefault;
    stepCounter++;    
    steps.removeClass('quiz__form-step--active');
    $(steps[stepCounter]).addClass('quiz__form-step--active');
    prevStep.fadeIn();

    stepPercent += 50;
    percentNumb.text(stepPercent + '%');
    
    $(percentIndicator[stepCounter - 1]).addClass('active');
    
    if (stepCounter == 2) {
        $('.quiz__wrap').addClass('last-steps');
        $('.quiz__bottom').addClass('active');
    } else if (stepCounter > 2) {
        $('.quiz__bottom').removeClass('active');
    }
    
    console.log(stepCounter)

    $('body,html').animate({
        scrollTop: 0
    }, 500);
    
}

const clickPrevStep = function(evt) {
    evt.preventDefault;
    stepCounter--;
    steps.removeClass('quiz__form-step--active');
    $(steps[stepCounter]).addClass('quiz__form-step--active');

    if (stepCounter === 2) {
        prevStep.fadeOut();
    }

    stepPercent -= 50;
    percentNumb.text(stepPercent + '%');

    $(percentIndicator[stepCounter]).removeClass('active');

    if (stepCounter < 2) {
        $('.quiz__wrap').removeClass('last-steps');
        $('.quiz__bottom').removeClass('active');
    }
    
    $('body,html').animate({
        scrollTop: 0
    }, 500);
}

const submit_with_communication_method = function(communication_method) {
    $('input[name="communication_method"]').val(communication_method);
}

nextStep.click(clickNextStep);
prevStep.click(clickPrevStep);



//кастомный скролл
// $('.quiz__form-step-content-col--map').scrollbar({
//     ignoreMobile: true
// });