<!doctype html>
<html lang="en">
<style>
img {
    display: block;
    z-index: 3;
}
#choises, #answers {
    display:block;
    padding: 0;
    margin: 0;
}
#choises li, #answers li {
    display: inline-block;
    height: 200px;
    width: 200px;
    margin: 10px;
    background: #515151;
}
#answers li {
    position: relative;
}
</style>
<ul id="choises">
    <li>
        <img src="http://placehold.it/200x200&text=1" />
    </li>
    <li>
        <img src="http://placehold.it/200x200&text=2" />
    </li>
    <li>
        <img src="http://placehold.it/200x200&text=3" />
    </li>
    <li>
        <img src="http://placehold.it/200x200&text=4" />
    </li>
</ul>
<ul id="answers">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
</ul>
</body>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    (function ($) {
    var lastPlace;

    $("#choises li img").draggable({
        revert: true,
        zIndex: 10,
        snap: "#answers li",
        snapMode: "inner",
        snapTolerance: 40,
        start: function (event, ui) {
            lastPlace = $(this).parent();
        }
    });

    $("#answers li").droppable({
        drop: function (event, ui) {
            var dropped = ui.draggable;
            var droppedOn = this;

            if ($(droppedOn).children().length > 0) {
                $(droppedOn).children().detach().prependTo($(lastPlace));
            }

            $(dropped).detach().css({
                top: 0,
                left: 0
            }).prependTo($(droppedOn));
        }
    });
})(jQuery);
</script>
</html>
