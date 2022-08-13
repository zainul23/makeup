$('.page-scroll').on('click',function(){var destination=$(this).attr('href');var toDestination=$(destination);$('html, body').animate({scrollTop:toDestination.offset().top-25});});
