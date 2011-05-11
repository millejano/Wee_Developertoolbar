var Cookie = {
    all: function() {
        var pairs = document.cookie.split(';');
        var cookies = {};
        pairs.each(function(item, index) {
            var pair = item.strip().split('=');
            cookies[unescape(pair[0])] = unescape(pair[1]);
        });

        return cookies;
    },
    read: function(cookieName) {
        var cookies = this.all();
        if(cookies[cookieName]) {
            return cookies[cookieName];
        }
        return null;
    },
    write: function(cookieName, cookieValue, cookieLifeTime) {
        var expires = '';
        if (cookieLifeTime) {
            var date = new Date();
            date.setTime(date.getTime()+(cookieLifeTime*1000));
            expires = '; expires='+date.toGMTString();
        }
        var urlPath = '/';
        document.cookie = escape(cookieName) + "=" + escape(cookieValue) + expires + "; path=" + urlPath;
    },
    clear: function(cookieName) {
        this.write(cookieName, '', -1);
    }
};

jQuery.noConflict();

jQuery(document).ready(function(){

  if (Cookie.read("developertoolbar") == 0)    {
    jQuery("#developerToolbar").hide();    
  }

  jQuery("#developerToolbarContainer img:first").click(function() {
    jQuery(".developerToolbarDetails").hide();
    jQuery("#developerToolbar").toggle();
    var display = jQuery("#developerToolbar").attr("style");
    var toolbarHiddenExpression = /(none)/;
    if (toolbarHiddenExpression.exec(display)) {
      Cookie.write("developertoolbar", 0);
    } else {
      Cookie.write("developertoolbar", 1);    
    }
  });    
  
  jQuery("ul.tabContainer li").click(function() {
    var id = jQuery(this).attr("id").split("_");
    id = id[1];
    var parent = jQuery(this).parent().parent();
    parentContainerId = jQuery(parent).attr("id");
    jQuery("#"+parentContainerId+ " ul.tabContainer li").removeClass("active");
    jQuery(this).addClass("active"); 
    var index = jQuery("#"+parentContainerId+ " ul.tabContainer li").index(this);
    jQuery("#"+parentContainerId+ " .tabContent").hide();
    jQuery("#tabContent_"+id).show();
  });
    
  jQuery("#developerToolbar li.content").click(function() {
    var id = jQuery(this).attr("id").split("_");
    id = id[1];
    jQuery(".developerToolbarDetails").each(function(e) {
      var toolbarDetailContainer = jQuery(".developerToolbarDetails").get(e);
      if (jQuery(toolbarDetailContainer).attr("id") != "developerToolbarDetails_"+id) {
        jQuery(toolbarDetailContainer).hide();     
      }
    });
    if (jQuery("#developerToolbarDetails_"+id)) {
      jQuery("#developerToolbarDetails_"+id).toggle();    
    }
  });
  
  jQuery("#tabContent_blocks a.toggleBlogProperties").click(function() {
    jQuery(this).next("ul.blockProperties").toggle(); 
  });
  
});

