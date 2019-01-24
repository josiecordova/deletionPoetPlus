// wrap words in spans
$("#grabbedText").each(function() {
    var $this = $(this);
    $this.html($this.text().replace(/\b(\w+)\b/g, "<span>$1</span>"));
});

// bind to each span
$('p span').hover(
    function() { $('#word').text($(this).css('background-color','#ffff66').text()); },
    function() { $('#word').text(''); $(this).css('background-color',''); }
);