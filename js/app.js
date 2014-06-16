(function()
{
	//scale images in grid to div size
	$('.gridimage').each(function(i, item)
	{
	    var img_height = $(item).height();
	    var div_height = $(item).parent().height();

	    if(img_height < div_height)
	    {
	        $(item).css({'width': 'auto', 'height': div_height });
	        var img_width = $(item).width();
	        var div_width = $(item).parent().width();
	        var newMargin = (div_width-img_width)/2+'px';
	        $(item).css({'margin-left': newMargin });
	    }
	    else
	    {
	        var newMargin = (div_height-img_height)/2+'px';
	        $(item).css({'margin-top': newMargin});
	    }
	});

	//validate login
	$("#txtcode").keyup(checkSixCharacters).blur(checkSixCharacters);

	function checkSixCharacters()
	{
		console.log('tetten');

		var $el = $(this);

		if ($el.val().length < 6) 
		{
			showInValid($el, $el.next(), "Gelieve minimum 6 karakters in te geven.");
		}
		else
		{
			showValid($el, $el.next());
		}
	}

	function showInValid($el, $errorEl, message)
	{
		$el.addClass("error");
		$errorEl.text(message);
	}

	function showValid($el, $errorEl)
	{
		$el.removeClass("error");
		$errorEl.text("tetten");
		$el.addClass("approved");
}
})();