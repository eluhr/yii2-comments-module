document.querySelectorAll("[data-remove-reply]").forEach(function (removeReplyButton) {
    removeReplyButton.addEventListener("click", function (event) {
        event.preventDefault();
        this.parentNode.classList.add("hidden");
        document.querySelector("[data-reply-quote='" + this.dataset.removeReply + "']").innerHTML = "";
        document.querySelector("[data-reply-parent-id='" + this.dataset.removeReply + "']").value = "";
    })
});

document.querySelectorAll("[data-reply]").forEach(function (replyButton) {
    replyButton.addEventListener("click", function (event) {
        event.preventDefault();
        document.querySelector("[data-widget-id='" + this.dataset.replyWidgetId + "']").classList.remove("hidden");
        document.querySelector("[data-reply-quote='" + this.dataset.replyWidgetId + "']").innerHTML = document.querySelector(".message[data-model-id='" + this.dataset.reply + "'][data-reply-widget-id='" + this.dataset.replyWidgetId + "']").innerHTML;
        document.querySelector("[data-reply-parent-id='" + this.dataset.replyWidgetId + "']").value = this.dataset.reply;
        console.log(document.querySelector(".message[data-model-id='" + this.dataset.reply + "'][data-reply-widget-id='" + this.dataset.replyWidgetId + "']").innerHTML)
    })
});