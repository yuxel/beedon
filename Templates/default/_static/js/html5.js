//http://ejohn.org/blog/html5-shiv/

( function(document) {
    var elements = ["header","nav","figure","footer","aside","article","hgroup"];

    for(i=0; i<elements.length; i++) {
        document.createElement(elements[i]);
    }
})(document);
