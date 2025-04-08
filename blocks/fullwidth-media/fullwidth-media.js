var initializeBlock = function () {

  
  
}

if (window.acf) {
    window.acf.addAction('render_block_preview/type=kodeks/boiler', initializeBlock);
} else {
    initializeBlock();
}