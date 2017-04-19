$(document).ready( function() {
	$("#sidebar li a.sidebar-nav-menu").on("click",function(){

		var nav_menus = $("#sidebar li a.sidebar-nav-menu");
		var active_index;
		var active_element;
		var not_active_count = 0;
		$(".sidebar-nav-menu").each(function(index, curr_element){
			//alert(index + " " + curr_element);
			if ($(curr_element).hasClass("active") == true)
			{
				active_index = index;
				active_element = curr_element;
				// $(curr_element).removeClass("active");
				// //$("a.sidebar-nav-menu").parent().find("ul").css({"display" : "none"});
				// $("a.sidebar-nav-menu").next().css({"display":"none"});
				// $(curr_element).find("span.glyphicon-menu-down").addClass("glyphicon-menu-right");
				// $(curr_element).find("span.glyphicon-menu-down").removeClass("glyphicon-menu-down");
				
				//$(this).find("span.glyphicon-menu-down").switchClass(".glyphicon-menu-down","glyphicon-menu-right", 3000);
			}
			else
			{
				not_active_count += 1;
				//$(curr_element).addClass("active");
				//$("a.sidebar-nav-menu.active").parent().find("ul").css({"display" : "block"});
				// $("a.sidebar-nav-menu.active").next().css({"display":"block"});
				// $(curr_element).find("span.glyphicon-menu-right").addClass("glyphicon-menu-down");
				// $(curr_element).find("span.glyphicon-menu-right").removeClass("glyphicon-menu-right");
				//$(this).find("span.glyphicon-menu-right").switchClass("glyphicon-menu-right", "glyphicon-menu-down", 3000);
			}
		});
		//alert(not_active_count);
		if (not_active_count == nav_menus.length)
		{
			$(this).addClass("active");	
			$("a.sidebar-nav-menu.active").next().css({"display":"block"});
			$(this).find("span.glyphicon-menu-right").addClass("glyphicon-menu-down");
			$(this).find("span.glyphicon-menu-right").removeClass("glyphicon-menu-right");
		}
		else
		{
			var curr_element_clicked = $(".sidebar-nav-menu").index(this);

			// if previously active element is equals to currently clicked element(a)
			if (active_index == curr_element_clicked)
			{
				//alert("g");
				$(this).removeClass("active");
				$("a.sidebar-nav-menu").next().css({"display":"none"});
				$(this).find("span.glyphicon-menu-down").addClass("glyphicon-menu-right");
				$(this).find("span.glyphicon-menu-down").removeClass("glyphicon-menu-down");
			}
			else
			{
				// previously active element is not equals to current clicked element
				//alert(active_element);
				$(active_element).removeClass("active");
				$(active_element).next().css({"display":"none"});
				$(active_element).find("span.glyphicon-menu-down").addClass("glyphicon-menu-right");
				$(active_element).find("span.glyphicon-menu-down").removeClass("glyphicon-menu-down");

				$(this).addClass("active");	
				$("a.sidebar-nav-menu.active").next().css({"display":"block"});
				$(this).find("span.glyphicon-menu-right").addClass("glyphicon-menu-down");
				$(this).find("span.glyphicon-menu-right").removeClass("glyphicon-menu-right");
			}
			
		}
	});

});