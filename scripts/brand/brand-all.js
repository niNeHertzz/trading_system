$(document).ready(function() {
	// $("#brand-table_length label").replaceWith("records per page");
	// brand table
	$("#brand-table thead tr th").first().css("width","5px");
	$("#brand-table thead tr th").removeClass("sorting");
	$("#brand-table tbody tr td:first-child").css({"padding-right": "5px", "padding-left": "12px"});

	// new brand modal
	$("#brand-add-btn").on("click", getNewBrandModal);
	function getNewBrandModal() {
		var xhttp = new XMLHttpRequest();
  		xhttp.onreadystatechange = function() {
    		if (this.readyState == 4 && this.status == 200) {
    			// append new brand modal to its wrapper and show it
    			$("#new-brand-dialog-wrapper").html(this.responseText);
    			$("#new-brand-dialog").modal({backdrop:false, keyboard:false});

    			// x button close remove the new category modal
    			$("#new-brand-dialog .modal-header button.close").on("click", function() {
					$("#new-brand-dialog-wrapper #new-brand-dialog").remove();
				});

    			// new brand save on click
				$("#new-brand-save").on("click", function() {
					
					// check if input txt is blank
					if ($("#new-brand-dialog input[name='brandtxt']").val() == "")
					{
						$("#new-brand-dialog span.brand-error").remove();
						$("#new-brand-dialog-wrapper #new-brand-dialog input[name='brandtxt']").
						after("<span class=\"brand-error\"></span>");
						$("#new-brand-dialog-wrapper span.brand-error").html("Please enter a brand.");
						$("#new-brand-dialog input[name='brandtxt']").focus();
					}
					else
					{
						// handle spacing issue(one space or more than one space) 
						// when checking if existing or not
						var word = $("input[name='brandtxt']").val().split(" ");
						var brandtxt_val = "";
						var word_counter = 0;
						for(count = 0;count < word.length;count++)
						{
							if(count == 0)
							{
								if(word[count] != "")
								{	
									word_counter += 1;
									//alert(counter);
									brandtxt_val += word[count];
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
										brandtxt_val += word[count];
									}
									else
									{
										brandtxt_val += " " + word[count];
									}	
									
								}
							}
						}
						if (brandtxt_val == "")
						{
							$("#new-brand-dialog span.brand-error").remove();
							$("#new-brand-dialog-wrapper #new-brand-dialog input[name='brandtxt']").
							after("<span class=\"brand-error\"></span>");
							$("#new-brand-dialog-wrapper span.brand-error").html("Please enter a brand.");
							$("#new-brand-dialog input[name='brandtxt']").focus();
						}
						else
						{
							// insert brand to db
							var xhttp = new XMLHttpRequest();
							xhttp.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200)
								{
									// brand txt has no matched brand in db - display success message
									if(this.responseText.trim() == "")
									{
										$("#new-brand-dialog span.brand-error").remove();
										$("#new-brand-dialog").modal("hide");

										// append category save modal to its wrapper and show it - success message
										xhttp.onreadystatechange = function() {
											if (this.readyState == 4 && this.status == 200)
											{
												$("#brand-save-dialog-wrapper").html(this.responseText);
												$("#brand-save-dialog").modal({backdrop:false, keyboard:false});
											}
										};
										xhttp.open("GET","../brand/brand_save_dialog.php", true);
										xhttp.send();
									}
									else
									{	// has matched category in db

										if ($("#new-brand-dialog span.brand-error").length > 0)
										{
											$("#new-brand-dialog span.brand-error").remove();
											$("#new-brand-dialog-wrapper #new-brand-dialog input[name='brandtxt']").
											after("<span class=\"brand-error\"></span>");
										}
										else
										{
											$("#new-brand-dialog-wrapper #new-brand-dialog input[name='brandtxt']").
											after("<span class=\"brand-error\"></span>");
										}	
										$("#new-brand-dialog-wrapper span.brand-error").html(this.responseText);
										$("#new-brand-dialog input[name='brandtxt']").focus();
									}
								}
							};
							xhttp.open("POST", "../brand/insert.php", true)
							xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							xhttp.send("brandtxt=" + brandtxt_val);
						}
					}
				});
      			//document.getElementById("main-content").innerHTML = this.responseText;
    		}
  		};
	  	xhttp.open("GET", "../brand/new_brand_dialog.php", true);
	  	xhttp.send();
	}
	
	// update brand
	//$("button[name='Update']").on("click", function() {
		
	//});
});

function updateBrandModal(id){
	var brandid = id;
		//alert($(this).attr("id"));

		// show update brand modal
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200)
			{
				// retrieve brand and display it on input type text
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200)
					{
						if ($("input[type='hidden']").length > 0)
						{
							$("input[type='hidden']").remove();
							$("#update-brand-dialog-wrapper input[name='brandtxt']").
							before("<input type='hidden' name='brandid' value='" + brandid + "' />");
						}
						else
						{
							$("#update-brand-dialog-wrapper input[name='brandtxt']").
							before("<input type='hidden' name='brandid' value='" + brandid + "' />");
						}
						$("#update-brand-dialog-wrapper input[name='brandtxt']").val(this.responseText);
					}
				};
				// append update brand modal to its wrapper and show it
				$("#update-brand-dialog-wrapper").html(this.responseText);
				$("#update-brand-dialog").modal({backdrop:false, keyboard:false});
				
				xhttp.open("GET", "../brand/retrievetxt.php?id=" + brandid, true);
				xhttp.send();

				$("#update-brand-dialog .modal-header button.close").on("click", function() {
					$("#update-brand-dialog-wrapper #update-brand-dialog").remove();
				});
				// update brand save on click
				$("#update-brand-save").on("click", function(){
					
					// check if input txt is blank
					if ($("#update-brand-dialog input[name='brandtxt']").val() == "")
					{
						$("#update-brand-dialog span.brand-error").remove();
						$("#update-brand-dialog-wrapper #update-brand-dialog input[name='brandtxt']").
						after("<span class=\"brand-error\"></span>");
						$("#update-brand-dialog-wrapper span.brand-error").html("Please enter a brand.");
						$("#update-brand-dialog input[name='brandtxt']").focus();
					}
					else
					{
						// handle spacing issue(one space or more than one space) when checking if existing or not
						var word = $("input[name='brandtxt']").val().split(" ");
						var brandtxt_val = "";
						var word_counter = 0;
						for(count = 0;count < word.length;count++)
						{
							if(count == 0)
							{
								if(word[count] != "")
								{
									word_counter += 1;
									brandtxt_val += word[count];
								}
							}
							else
							{
								if(word[count] != "")
								{
									word_counter += 1;
									if (word_counter == 1)
									{
										brandtxt_val += word[count];
									}
									else
									{
										brandtxt_val += " " + word[count];
									}
								}
							}
						}
						if (brandtxt_val == "")
						{
							$("#update-brand-dialog span.brand-error").remove();
							$("#update-brand-dialog-wrapper #update-brand-dialog input[name='brandtxt']").
							after("<span class=\"brand-error\"></span>");
							$("#update-brand-dialog-wrapper span.brand-error").html("Please enter a brand.");
							$("#update-brand-dialog input[name='brandtxt']").focus();
						}
						else
						{
							// update specific brand in db or display error if existing
							var xhttp = new XMLHttpRequest();
							xhttp.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200)
								{
									// brand txt has no matched brand in db - display success message
									if(this.responseText.trim() == "")
									{
										$("#update-brand-dialog span.brand-error").remove();
										$("#update-brand-dialog").modal("hide");

										// append brand save modal to its wrapper and show it - success message
										xhttp.onreadystatechange = function() {
											if (this.readyState == 4 && this.status == 200)
											{
												$("#brand-save-dialog-wrapper").html(this.responseText);
												$("#brand-save-dialog").modal({backdrop:false, keyboard:false});
											}
										};
										xhttp.open("GET", "../brand/brand_save_dialog.php", true);
										xhttp.send();
									}
									else
									{	// has matched brand in db

										if ($("#update-brand-dialog span.brand-error").length > 0)
										{
											$("#update-brand-dialog span.brand-error").remove();
											$("#update-brand-dialog-wrapper #update-brand-dialog input[name='brandtxt']").
											after("<span class=\"brand-error\"></span>");
										}
										else
										{
											$("#update-brand-dialog-wrapper #update-brand-dialog input[name='brandtxt']").
											after("<span class=\"brand-error\"></span>");
										}	
										$("#update-brand-dialog-wrapper .brand-error").html(this.responseText);
										$("#update-brand-dialog input[name='brandtxt']").focus();
									}
								}
							};
							xhttp.open("POST", "../brand/update.php", true);
							xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
							xhttp.send("brandid=" + $("input[name='brandid']").val() +   
									   "&brandtxt=" + brandtxt_val);
						}
					}
				});
			}
		};
		xhttp.open("GET", "../brand/update_brand_dialog.php", true);
		xhttp.send();
}