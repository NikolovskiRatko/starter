const isBodyOverflowing = () : boolean  => {
  const rect = document.body.getBoundingClientRect();
  return Math.round(rect.left + rect.right) < window.innerWidth;
};

const getScrollbarWidth = () : number => {
  const scrollDiv = document.createElement('div');
  scrollDiv.className = 'sk-modal-scrollbar-measure';
  document.body.appendChild(scrollDiv);
  const scrollbarWidth = scrollDiv.getBoundingClientRect().width - scrollDiv.clientWidth;
  scrollDiv.remove();
  return scrollbarWidth;
};

export { isBodyOverflowing , getScrollbarWidth  };
