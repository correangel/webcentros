(function($) {
  /**
   * Upload functions.
   **/
  $.fn.ft_upload = function(options) {
    return this.each(function() {
      $(this).find('input[type=file]').change(function(){
  			$(this).parent().after("<div class=\"well\"><h5>"+options.header+"</h5><ul id=\"files_list\"></ul></div>");
        uploadCallback(this, options);
  		});
  		$(this).find("#uploadbutton").click(function(){
  		  // Hide upload button.
        $("#uploadbutton").hide();
        $("#create .info").hide();
        $("#uploadbutton").after("<p class='error'>"+options.upload+"</p>");
  		});

    });
  };
	function niceFileName(name) { // Truncates a file name to 20 characters.
    var noext = name;
    var ext = '';
    if (name.match('.')) {
      noext = name.substr(0, name.lastIndexOf('.'));
      ext = name.substr(name.lastIndexOf('.'));
    }
    if (noext.length > 20) {
      name = noext.substr(0, 20)+'...';
      if (ext != '') {
        name = name+ '.' +ext;
      }
    }
    return name;
	}
	function uploadCallback(obj, options) { // Gets fired every time a new file is selected for upload.
		// Safari has a weird bug so we can't hide the object in the normal fashion:
		$(obj).addClass("safarihide");
		// Make random number:
		var d = new Date();
		var t = d.getTime();
		$(obj).parent().prepend('<input type="file" class="upload" name="localfile-'+t+'" id="localfile-'+t+'" />');
		$('#localfile-'+t).change(function() {uploadCallback(this, options)});
		if (obj.value.indexOf("/") != -1) {
			var v = obj.value.substr(obj.value.lastIndexOf("/")+1);
		} else if (obj.value.indexOf("\\") != -1) {
			var v = obj.value.substr(obj.value.lastIndexOf("\\")+1);
		} else {
			var v = obj.value;
		}
		if(v != '') {
			$("#files_list").append('<li>'+niceFileName(v)+" <span class=\"btn btn-danger btn-xs\" title=\""+options.cancel+"\"><i class=\"fas fa-trash\"></i></span></li>").find("span").click(function(){
				$(this).parent().remove();
				$(obj).remove();
				return true;
			});
		}
	};
	/**
   * File list functions.
   **/
	$.fn.ft_filelist = function(options) {
    return this.each(function() {
      // Make background color on table rows show up nicely on hover
  		$(this).find("tr").hover(
        function(){$(this).toggleClass('rowhover');},
        function(){$(this).toggleClass('rowhover')}
  		);
      // Hover on the diamond.
      $(this).find("td.details span.show").hover(
        function(){$(this).toggleClass('hover')},
        function(){$(this).toggleClass('hover')}
      );
      // Hide file details on second diamond click.
  		$(this).find("td.details span.hide").hover(
  		  function(){$(this).toggleClass('hover')},
  		  function(){$(this).toggleClass('hover')}
  		).click(function(){
  			$(this).parent().parent().next().remove();
  			$(this).hide();
  			$(this).prev().show();
  		});
  		// Build file details box on diamond click.
      $(this).find("td.details span.show").click(function(){
        if ($(this).hasClass("writeable")) {

          if (! $(this).hasClass("open")) {
            $( ".filedetails" ).remove(); // Close all filedetails
            $(this).addClass("open"); // Set open filedetails
            $(this).parent().parent().after("<tr class='filedetails'></tr>");
            // Default actions.
      			var actions = {
      			  rename: options.rename_link,
      			  move: options.move_link,
      			  del: options.del_link
      			};
      			// Add 'duplicate' for files only.
      			if ($(this).parent().parent().hasClass('file')) {
    			    actions.duplicate = options.duplicate_link;
            }

            // Add 'share' for private files only.
            var location_search = window.location.search;
            if ($(this).parent().parent().hasClass('file') && (location_search.substr(0,14) == '?index=privado')) {
    			    actions.share = options.share_link;
    			  }

      			// Add other options.
            for (i in options.fileactions) {
              if ($(this).hasClass(i)) {
                actions[i] = options.fileactions[i].link;
              }
            }

      			// Convert actions list into html list.
      			var list = '';
      			for (i in actions) {
      			  list = list+'<li class="'+i+'">'+actions[i]+'</li>';
      			}
      			// Append file actions box.
      			var filename = $(this).parent().parent().find("td.name").text();
      			$(this).parent().parent().next("tr.filedetails").append("<td colspan=\"4\"><ul class=\"list-inline navigation\">"+list+"</ul><form method=\"post\" class=\"form-inline\" action=\""+options.formpost+"\"><div><label for='newvalue'>"+options.rename+"</label><input type=\"text\" value=\""+filename+"\" class='form-control input-sm' name=\"newvalue\" /><input type=\"hidden\" value=\""+filename+"\" class='file' name=\"file\" /><input type=\"submit\" class='btn btn-primary btn-sm submit' value=\""+options.ok+"\" /><input type=\"hidden\" name=\"dir\" value=\""+options.directory+"\" /><input type=\"hidden\" name=\"act\" class=\"act\" value=\"rename\" /></div></form></td>")
      			.find("li").hover(
      			  function(){$(this).toggleClass('hover')},
      			  function(){$(this).toggleClass('hover')}
      			).click(function(){
      			  showOption(this, options);
      			});

    				// Focus on new value field.
    				$(this).parent().parent().next("tr.filedetails").find("input.form-control").get(0).focus();
    				$(this).parent().parent().next("tr.filedetails").find("input.form-control").get(0).select();

    				// Hide one diamond, show the other.
    				$(this).hide();
      			$(this).next().show();

            $(this).removeClass("open"); // Remove class open
          }
          else {
            $( ".filedetails" ).remove(); // Remove all filedetails
            $(this).removeClass("open"); // Remove class open
          }
    		}
      });
    });
  };
  function showOption(obj, options) { // Shows a selection from the file details menu.
    var section = $(obj).attr('class').replace('hover', '').replace(' ', '');
		var act = $(obj).parent().parent().find("input.act");
		var newval = $(obj).parent().parent().find("input.form-control");
		var file = $(obj).parent().parent().find("input.file").val();
		var label = $(obj).parent().parent().find("label");
		var submit = $(obj).parent().parent().find("input.submit");
		// Un-select all <li>
		$(obj).parent().find("li").removeClass("selected");
		$(obj).addClass("selected");
		// Show/hide the new value field and change the text of the submit button.
		if (section.match('rename') || section.match('move') || section.match('duplicate')) {
			// Show new value field.
			newval.show();
			label.empty();
			submit.show();
			if (section.match('rename')) {
				label.append(options.rename);
				newval.val(file);
    		act.val('rename');
			} else if (section.match('move')) {
				label.append(options.move);
				newval.val("");
    		act.val('move');
			} else if (section.match('duplicate')) {
				label.append(options.duplicate);
				if (file.indexOf(".") != -1) {
					newval.val(file.substring(0, file.lastIndexOf("."))+" (copia)"+file.substr(file.lastIndexOf(".")));
				} else {
					newval.val(file+" (copia)");
				}
    		act.val('duplicate');
      }
			submit.val(options.ok);
			// Set focus on new value field.
			newval.get(0).focus();
			newval.get(0).select();
		} else if (section.match('del')) {
			// Hide new value field.
			newval.hide();
			label.empty();
			if (!$(obj).parents('tr.filedetails').prev().find('td.details span.show').eq(0).hasClass('empty') && $(obj).parents('tr.filedetails').prev().find('td.details span.show').eq(0).hasClass('dir')) {
  			label.append(options.del_warning);
  			submit.hide();
			} else {
  			label.append(options.del);
			}
      submit.show();
			submit.val(options.del_button);
  		act.val('delete');
    } else if (section.match('share')) {
      label.empty();

      var dir = '';
      var location_search = window.location.search;
      if (location_search.substr(0,20) == '?index=privado&dir=/') {
        dir = location_search.substr(20) + '/';
      }
      var download_uri = window.location.protocol + '//' + window.location.hostname + '/intranet/varios/' + options.user_idea + '/' + dir + file.trim();
      var downloadEncodeHTML = encodeURI("<p><br></p><p><br></p>Archivo adjunto:<br><span class=\"fas fa-download fa-lg fa-fw\"></span> <a href=\"" + download_uri + "\">" + file.trim() + "</a>");
      window.location.href = window.location.protocol + '//' + window.location.hostname + '/intranet/admin/mensajes/redactar.php?texto=' + downloadEncodeHTML;

      newval.hide();
      submit.hide();
      act.val('share');
    } else {
      // See if plugin has defined this section.
      if (options.fileactions[section]) {
        if (options.fileactions[section].type == 'sendoff') {
           // Simple sendoff. Hide new value field.
           newval.hide();
           label.empty();
           label.append(options.fileactions[section].text);
           submit.val(options.fileactions[section].button)
           act.val(section);
        }
      }
    }
	};


})(jQuery);
