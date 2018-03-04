var simplemde = new SimpleMDE({
    element: $("#assignmentContent")[0],
    spellChecker: false
});

simplemde.codemirror.on('refresh', function(){
    if($(simplemde.element).closest('.form-group').find('.CodeMirror').hasClass('CodeMirror-fullscreen')){
        ContentNavTabs.makeFixed();
    }else{
        ContentNavTabs.makeRelative();
    }
});