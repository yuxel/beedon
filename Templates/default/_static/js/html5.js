//http://ejohn.org/blog/html5-shiv/

( function(document) {
    var elements = ["header","nav","figure","footer","aside","article"];

    for(i=0; i<elements.lenth; i++) {
        document.createElement(elements[i]);
    }
})(document);
