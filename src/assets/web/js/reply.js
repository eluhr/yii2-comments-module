var replyToCommentEl = $(".reply-to-comment");
var replyToCommentQuote = replyToCommentEl.find("blockquote");
var replyInput = $("#comment-parent_comment_id");
$("[data-reply]").on("click" ,function(event) {
    event.preventDefault();
    replyInput.val($(this).data("reply"));
    replyToCommentEl.removeClass("hidden");
    replyToCommentQuote.html($(this).data("message"));
});
$("[data-remove-reply]").on("click" ,function(event) {
    event.preventDefault();
    replyInput.val("");
    replyToCommentEl.addClass("hidden");
    replyToCommentQuote.html("");

});