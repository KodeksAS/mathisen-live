var initializeBlock = function () {
    console.log('Hello world');
}

if (window.acf) {
    window.acf.addAction('render_block_preview/type=kodeks/quote-block', initializeBlock);
} else {
    initializeBlock();
}