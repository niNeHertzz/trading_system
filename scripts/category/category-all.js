$(document).ready(function() {
	// $("#category-table_length label").replaceWith("records per page");
	var count = 0;
	// category table
	$("#category-table thead tr th").first().css("width","5px");
	$("#category-table thead tr th").removeClass("sorting");
	$("#category-table tbody tr td:first-child").css({"padding-right": "5px", "padding-left": "12px"});

	// new category modal
	$("#category-add-btn").on("click", getNewCategoryModal);
	function getNewCategoryModal() 
	{
		var xhttp = new XMLHttpRequest();
  		xhttp.onreadystatechange = function() 
  		{
    		if (this.readyState == 4 && this.status == 200) {
    			// append new category modal to its wrapper and show it
    			$("#new-category-dialog-wrapper").html(this.responseText);
    			$("#new-category-dialog").modal({backdrop:false, keyboard:false});

    			// x button close remove the new category modal
    			$("#new-category-dialog .modal-header button.close").on("click", function() {
					$("#new-category-dialog-wrapper #new-category-dialog").remove();
				});

    			// new category save on click
    			$("#new-category-save").on("click", function() {
					
					// check if input txt is blank
					if ($("#new-category-dialog input[name='categorytxt']").val() == "")
					{
						$("#new-category-dialog span.category-error").remove();
						$("#new-category-dialog-wrapper #new-category-dialog input[name='categorytxt']").
						after("<span class=\"category-error\"></span>");
						$("#new-category-dialog-wrapper span.category-error").html("Please enter a category.");
						$("#new-category-dialog input[name='categorytxt']").focus();
					}
					else
					{
						// handle spacing issue(one space or more than one space) 
						// when checking if existing or not
						var word = $("input[name='categorytxt']").val().split(" ");
						var categorytxt_val = "";
						var word_counter = 0;
						for(count = 0;count < word.length;count++)
						{
							if(count == 0)
							{
								if(word[count] != "")
								{	
									word_counter += 1;
									//alert(counter);
									categorytxt_val += word[count];
								}
							}
							else
							{
								if (word[count] != "")
								{
									word_counter += 1;
									//alert(counter);
									if (word_counter == 1)
									{
										categorytxt_val += word[count];
									}
									else
									{
										categorytxt_val += " " + word[count];
									}	
									
								}
							}
						}
						//alert(categorytxt_val);
						if (categorytxt_val == "")
						{
							$("#new-category-dialog span.category-error").remove();
							$("#new-category-dialog-wrapper #new-category-dialog input[name='categorytxt']").
							after("<span class=\"category-error\"></span>");
							$("#new-category-dialog-wrapper span.category-error").html("Please enter a category.");
							$("#new-category-dialog input[name='categorytxt']").focus();
						}
						else
						{
							//insert category to db
							var xhttp = new XMLHttpRequest();
							xhttp.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200)
								{
									// category txt has no matched category in db - display success message
									if(this.responseText.trim() == "")
									{
										$("#new-category-dialog span.category-error").remove();
										$("#new-category-dialog").modal("hide");
										
										// append category save modal to its wrapper and show it - success message
										xhttp.onreadystatechange = function() {
											if (this.readyState == 4 && this.status == 200)
											{
												$("#category-save-dialog-wrapper").html(this.responseText);
												$("#category-save-dialog").modal({backdrop:false, keyboard:false});
											}
										};
										xhttp.open("GET","../category/category_save_dialog.php", true);
										xhttp.send();
									}
									else
									{	// has matched category in db

										if ($("#new-category-dialog span.category-error").length > 0)
										{
											$("#new-category-dialog span.category-error").remove();
											$("#new-category-dialog-wrapper #new-category-dialog input[name='categorytxt']").
											after("<span class=\"category-error\"></span>");
										}
										else
										{
											$("#new-category-dialog-wrapper #new-category-dialog input[name='categorytxt']").
											after("<span class=\"category-error\"></span>");
										}	
										$("#new-category-dialog-wrapper span.category-error").html(this.responseText);
										$("#new-category-dialog input[name='categorytxt']").focus();
									}
									// inside this readyState condition the block of state show or display the response only
									//$(".category-contents tbody").html(this.responseText);
								}
							};
							xhttp.open("POST", "../category/insert.php", true)
							xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							xhttp.send("categorytxt=" + categorytxt_val);
						}
					}
				});
      			//document.getElementById("main-content").innerHTML = this.responseText;
    		}
  		};
	  	xhttp.open("GET", "../category/new_category_dialog.php", true);
	  	xhttp.send();
	}

	// update category 
	//$(".category-contents tbody button").on("click", function() {

	//});
		
	// $(".category-contents table tbody button").on("click", function() {
	// 	//alert($(this).attr("name"));
		
	// 	count += 1;
	// 	var id = $(this).attr("name").slice(6);
	// 	alert(id);
	// 	var xhttp = new XMLHttpRequest();
	// 	xhttp.onreadystatechange = function() {
	// 		$("#update-category-dialog-wrapper").html(this.responseText);
	// 		$("#update-category-dialog").modal("show");
	// 	};
	// 	xhttp.open("GET", "../category/update_category_dialog.php?id=" + id, true);
	// 	xhttp.send();
	// });

});
function updateCategoryModal(id)
{
	//alert("wew");
		var categoryid = id;//$(this).attr("id");
		//alert($(this).attr("id"));

		// show update category modal
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200)
			{
				// retrieve category and display it on input type text
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200)
					{
						if ($("input[type='hidden']").length > 0)
						{
							$("input[type='hidden']").remove();
							$("#update-category-dialog-wrapper input[name='categorytxt']").
							before("<input type='hidden' name='catid' value='" + categoryid + "' />");
						}
						else
						{
							$("#update-category-dialog-wrapper input[name='categorytxt']").
							before("<input type='hidden' name='catid' value='" + categoryid + "' />");
						}
						$("#update-category-dialog-wrapper input[name='categorytxt']").val(this.responseText);
					}
				};
				// append update category modal to its wrapper and show it
				$("#update-category-dialog-wrapper").html(this.responseText);
				$("#update-category-dialog").modal({backdrop:false, keyboard:false});
				
				xhttp.open("GET", "../category/retrievetxt.php?id=" + categoryid, true);
				xhttp.send();

				$("#update-category-dialog .modal-header button.close").on("click", function() {
					$("#update-category-dialog-wrapper #update-category-dialog").remove();
				});
				// update category save on click
				$("#update-category-save").on("click", function(){
					
					// check if input txt is blank
					if ($("#update-category-dialog input[name='categorytxt']").val() == "")
					{
						$("#update-category-dialog span.category-error").remove();
						$("#update-category-dialog-wrapper #update-category-dialog input[name='categorytxt']").
						after("<span class=\"category-error\"></span>");
						$("#update-category-dialog-wrapper .category-error").html("Please enter a category.");
						$("#update-category-dialog input[name='categorytxt']").focus();
					}
					else
					{
						// handle spacing issue(one space or more than one space) when checking if existing or not
						var word = $("input[name='categorytxt']").val().split(" ");
						var categorytxt_val = "";
						var word_counter = 0;
						for(count = 0;count < word.length;count++)
						{
							if(count == 0)
							{
								if(word[count] != "")
								{
									word_counter += 1;
									categorytxt_val += word[count];
								}
							}
							else
							{
								if(word[count] != "")
								{
									word_counter += 1;
									if (word_counter == 1)
									{
										categorytxt_val += word[count];
									}
									else
									{
										categorytxt_val += " " + word[count];
									}
								}
							}
						}
						if (categorytxt_val == "")
						{
							$("#update-category-dialog span.category-error").remove();
							$("#update-category-dialog-wrapper #update-category-dialog input[name='categorytxt']").
							after("<span class=\"category-error\"></span>");
							$("#update-category-dialog-wrapper .category-error").html("Please enter a category.");
							$("#update-category-dialog input[name='categorytxt']").focus();
						}
						else
						{
							// update specific category in db or display error if existing
							var xhttp = new XMLHttpRequest();
							xhttp.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200)
								{
									// category txt has no matched category in db - display success message
									if(this.responseText.trim() == "")
									{
										$("#update-category-dialog span.category-error").remove();
										$("#update-category-dialog").modal("hide");

										// append category save modal to its wrapper and show it - success message
										xhttp.onreadystatechange = function() {
											if (this.readyState == 4 && this.status == 200)
											{
												$("#category-save-dialog-wrapper").html(this.responseText);
												$("#category-save-dialog").modal({backdrop:false, keyboard:false});
											}
										};
										xhttp.open("GET", "../category/category_save_dialog.php", true);
										xhttp.send();
									}
									else
									{	// has matched category in db

										if ($("#update-category-dialog span.category-error").length > 0)
										{
											$("#update-category-dialog span.category-error").remove();
											$("#update-category-dialog-wrapper #update-category-dialog input[name='categorytxt']").
											after("<span class=\"category-error\"></span>");
										}
										else
										{
											$("#update-category-dialog-wrapper #update-category-dialog input[name='categorytxt']").
											after("<span class=\"category-error\"></span>");
										}	
										$("#update-category-dialog-wrapper .category-error").html(this.responseText);
										$("#update-category-dialog input[name='categorytxt']").focus();
									}
								}
							};
							xhttp.open("POST", "../category/update.php", true);
							xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							xhttp.send("categoryid=" + $("input[name='catid']").val() +   
									   "&categorytxt=" + categorytxt_val);
						}
					}
				});
			}
		};
		xhttp.open("GET", "../category/update_category_dialog.php", true);
		xhttp.send();
}
// function to show update category modal
// function updateCategoryModal(categoryid)
// {
// 	//alert($("#category_value_"+categoryid).html());
// 	//$("input[name='categorytxt']").val($("#category_value_"+categoryid).html());

// 	var xhttp = new XMLHttpRequest();
// 	// retrieve category txt php
// 	// xhttp.onreadystatechange = function() {
// 	// 	if (this.readyState == 4 && this.status == 200)
// 	// 	{
// 			// append update category modal to its wrapper in the category content file
// 			xhttp.onreadystatechange = function() {
// 				if (this.readyState == 4 && this.status == 200)
// 				{
// 					// retrieve category and display it on input type text
// 					xhttp.onreadystatechange = function() {
// 						if (this.readyState == 4 && this.status == 200)
// 						{
// 							if ($("input[type='hidden']").length > 0)
// 							{
// 								$("input[type='hidden']").remove();
// 								$("#update-category-dialog-wrapper input[name='categorytxt']").before("<input type='hidden' name='catid' value='" 
// 																								  + categoryid + "' />");
// 							}
// 							else
// 							{
// 								$("#update-category-dialog-wrapper input[name='categorytxt']").before("<input type='hidden' name='catid' value='" 
// 																								  + categoryid + "' />");
// 							}
// 							$("#update-category-dialog-wrapper input[name='categorytxt']").val(this.responseText);
// 						}
// 					};
// 					$("#update-category-dialog-wrapper").html(this.responseText);
// 					$("#update-category-dialog").modal("show");

// 					xhttp.open("GET", "../category/retrievetxt.php?id=" + categoryid, true);
// 					xhttp.send();
// 				}
// 			};
// 			xhttp.open("GET", "../category/update_category_dialog.php", true);
// 			xhttp.send();
// 	// 	}
// 	// };
// 	// xhttp.open("GET", "../category/retrievetxt.php?id=" + categoryid, true);
// 	// xhttp.send();
// }