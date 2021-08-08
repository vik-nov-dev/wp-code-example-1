(function() {
  tinymce.PluginManager.add('theme_mce_button', function( editor, url ) {
    editor.addButton('theme_mce_button', {
      text: 'BTN',
      icon: false,
      onclick: function() {
        let out = '<a class="btn btn-theme btn-angle-right" href="';
        let text = prompt('Button Text?');
        let link = prompt('Button Link?');
        let newTab = confirm('Open in a new tab?');
        out += link + '"';
        if (newTab)
          out += ' target="_blank"'
        out += '>';
        out += text;
        out += '</a>';
        editor.insertContent(out);
      }
    });
  });
})();