/*global $ , console , alert , document, window */
$(function() {
'use strict';


$("#cont").click(function() {
    $('html, body').animate({
        scrollTop: $(".contact").offset().top
    }, 2000);
});


    
//At Services page
$(".fxdmenu #web").click(function() {
    $('html, body').animate({
        scrollTop: $(".first").offset().top
    }, 1500);
});
$(".fxdmenu #app").click(function() {
    $('html, body').animate({
        scrollTop: $(".app").offset().top 
    }, 1500);
});
$(".fxdmenu #iden").click(function() {
    $('html, body').animate({
        scrollTop: $(".desi").offset().top
    }, 1500);
});
$(".fxdmenu #media").click(function() {
    $('html, body').animate({
        scrollTop: $(".media").offset().top
    }, 1500);
});
$(".fxdmenu #mark").click(function() {
    $('html, body').animate({
        scrollTop: $(".mark").offset().top
    }, 1500);
});

    
$(".fxdmenu .head").click(function() {
    $('.fxdmenu').toggleClass("hover");
});


    
});