$('[data-autogro]').each(textarea => {
    textarea.setAttribute("style", "height:" + (textarea.scrollHeight) + "px;overflow-y:hidden;");
})

$(document).on('input', '[data-autogrow]', function() {
    this.style.height = "auto";
    this.style.height = (this.scrollHeight) + "px";
    this.style.overflowY = "hidden";
});
