var initializeBlock = function () {
  const imgWrapper = document.querySelector('.img-wrapper');
  const img = imgWrapper.querySelector('img');
  
  window.addEventListener('resize', () => {
    const viewportWidth = window.innerWidth;
    const bleedAmount = Math.min(viewportWidth / 2, 500); // Control the max amount the image bleeds out
    
    img.style.left = `-${bleedAmount}px`;
  });
}

if (window.acf) {
    window.acf.addAction('render_block_preview/type=kodeks/text-and-image', initializeBlock);
} else {
    initializeBlock();
}