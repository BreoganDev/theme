wp.customize.bind('change', function(setting) {
    if (setting.id.startsWith('breogan_stat') || setting.id.startsWith('breogan_feature')) {
        const iconClass = setting.get();
        const previewIcon = document.querySelector('.' + setting.id);
        if (previewIcon) {
            previewIcon.className = 'fas ' + iconClass;
        }
    }
});
