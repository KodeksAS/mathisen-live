/* 
*   Carousel: Custom carousel
*/

export default class Carousel {
  constructor(args) {
    this.el = args.el
    this.wrapper = args.wrapper
    this.slides = this.wrapper.querySelectorAll('li')
    this.pagination = args.pagination
    this.arrows = args.arrows
    this.queries = args.queries
    this.gridUpdated = 3
    this.gap = getComputedStyle(this.wrapper)
    this.subtractGap = parseInt(this.gap['column-gap']) * (this.gridUpdated - 1) / this.gridUpdated
    this.arrowsMade = false
    this.autoHeight = args.autoHeight ? args.autoHeight : false
    this.autoPlay = args.autoPlay ? args.autoPlay : false

    this.swipe()
    this.resizeSize()

    // Disable/enable scroll checks
    let supportsPassive = false
    try {
      window.addEventListener("test", null, Object.defineProperty({}, 'passive', {
        get: function () { supportsPassive = true }
      }))
    } catch (e) { }

    this.wheelOpt = supportsPassive ? { passive: false } : false
    this.wheelEvent = 'onwheel' in document.createElement('div') ? 'wheel' : 'mousewheel'


    // Responsive inits
    this.queries.forEach(el => {

      const mediaQueryList = window.matchMedia(el.query)

      mediaQueryList.addEventListener('change', event => {
        this.setGrid(event, el)
        this.makePagination(event, el)
        this.clickPagination()
        this.makeArrows()
      })

      window.addEventListener('load', event => {
        this.setGrid(mediaQueryList, el)
        this.makePagination(mediaQueryList, el)
        this.clickPagination()
        this.makeArrows()
      })
    })

    this.autoPlay ? this.play() : null

  }

  setGrid(event, e) {
    if (event) {
      if (event.matches) {
        this.width = this.el.offsetWidth / e.grid
        this.gridUpdated = e.grid

        this.slides.forEach((element, index) => {

          if (this.gridUpdated == 1) {
            element.style.width = this.width + 'px'
          } else {
            element.style.width = (this.width - this.subtractGap) + 'px'
          }

        })
      }
    }
  }

  resizeSize() {
    window.addEventListener('resize', e => {

      this.width = this.el.offsetWidth / this.gridUpdated

      this.slides.forEach((element, index) => {

        if (this.gridUpdated == 1) {
          element.style.width = this.width + 'px'
        } else {
          element.style.width = (this.width - this.subtractGap) + 'px'
        }
      })
    })
  }

  makePagination(event, e) {
    if (event) {
      if (event.matches) {

        this.pagination.innerHTML = ''

        this.slides.forEach((element, index) => {
          const bullet = document.createElement('li')

          if (this.gridUpdated < this.slides.length) {

            if (this.gridUpdated == 1) {
              if (index == 0) {
                bullet.classList.add('active')
              }
            } else {
              if (index == 1) {
                bullet.classList.add('active')
              }
            }

            if (this.gridUpdated == 1) {
              this.pagination.append(bullet)
            } else if (this.gridUpdated > 2) {
              if (index != 0 && (index + 1) != this.slides.length) {
                this.pagination.append(bullet)
              }
            } else {
              if (index != 0) {
                this.pagination.append(bullet)
              }
            }
          }

        })

      }
    }
  }

  clickPagination() {
    this.pagination.querySelectorAll('li').forEach((element, index) => {

      element.addEventListener('click', e => {

        let newIndex = index + 1
        let translate = ((this.width - this.subtractGap) + parseInt(this.gap['column-gap']))
        let transformIndex = newIndex + 1

        if (this.gridUpdated == 1) {
          transformIndex = index
          translate = translate * transformIndex + (this.subtractGap * transformIndex)
        } else {
          // If last or second to last element
          if ((newIndex + 1) == this.slides.length || (newIndex + 1) == (this.slides.length - 1) && this.gridUpdated > 2) {
            transformIndex = this.slides.length - this.gridUpdated

          } else {
            transformIndex = newIndex - 1

            // First element
            if (newIndex == 0) {
              transformIndex = newIndex
            }
          }

          translate = translate * transformIndex
        }

        this.wrapper.style.transform = 'translateX(-' + translate + 'px)'

        this.pagination.querySelectorAll('li').forEach(e => {
          e.classList.remove('active')
        })

        element.classList.add('active')

        this.bullets = this.pagination.querySelectorAll('li')

        if (this.arrows) {
          if (element == this.bullets[this.bullets.length - 1]) {
            this.nextBtn.classList.add('hide')
          } else {
            this.nextBtn.classList.remove('hide')
          }

          if (element == this.bullets[0]) {
            this.prevBtn.classList.add('hide')
          } else {
            this.prevBtn.classList.remove('hide')
          }
        }

        if (this.autoHeight) {
          this.setHeight(this.slides[index])
        }

        transformIndex = index
      })
    })
  }

  setHeight(element) {
    let resizeObserver = new ResizeObserver(entries => {
      for (let entry of entries) {
        this.wrapper.style.height = entry.contentRect.height + 'px'
      }
    })

    resizeObserver.observe(element)
  }

  makeArrows() {

    if (this.arrows && this.arrowsMade == false && this.gridUpdated < this.slides.length) {
      this.prevBtn = document.createElement('button')
      this.nextBtn = document.createElement('button')

      this.prevBtn.appendChild(document.createElement('span'))
      this.prevBtn.classList.add('prev', 'hide')
      this.prevBtn.setAttribute('aria-label', 'Forrige')
      this.nextBtn.appendChild(document.createElement('span'))
      this.nextBtn.classList.add('next')
      this.nextBtn.setAttribute('aria-label', 'Neste')

      this.el.append(this.prevBtn)
      this.el.append(this.nextBtn)

      this.arrowsMade = true

      this.clickArrows()

    } else if (this.gridUpdated >= this.slides.length && this.arrowsMade == true) {
      this.prevBtn.remove()
      this.nextBtn.remove()

      this.arrowsMade = false
    }

    if (this.autoHeight) {
      this.setHeight(this.slides[0])
    }

  }

  clickArrows() {
    this.bullets = this.pagination.querySelectorAll('li')

    this.nextBtn.addEventListener('click', e => {
      if (this.pagination.querySelector('.active') != this.bullets[this.bullets.length - 1]) {
        this.pagination.querySelector('.active').nextSibling.click()
        clearTimeout(this.autoPlayTimeout)
      }
      this.autoPlay = false
    })

    this.prevBtn.addEventListener('click', e => {

      if (this.pagination.querySelector('.active') != this.bullets[0]) {
        this.pagination.querySelector('.active').previousSibling.click()
        clearTimeout(this.autoPlayTimeout)
      }
      this.autoPlay = false

    })

  }

  preventDefault(e) {
    e.preventDefault()
  }

  disableScroll() {
    window.addEventListener('DOMMouseScroll', this.preventDefault, false) // older FF
    window.addEventListener(this.wheelEvent, this.preventDefault, this.wheelOpt) // modern desktop
    window.addEventListener('touchmove', this.preventDefault, this.wheelOpt) // mobile
  }

  enableScroll() {
    window.removeEventListener('DOMMouseScroll', this.preventDefault, false)
    window.removeEventListener(this.wheelEvent, this.preventDefault, this.wheelOpt)
    window.removeEventListener('touchmove', this.preventDefault, this.wheelOpt)
  }

  swipe() {
    let touchstartX = 0
    let touchstartY = 0
    let touchmoveX = 0
    let touchmoveY = 0
    let touchendX = 0
    let touchendY = 0

    this.el.addEventListener('touchstart', event => {
      touchstartX = event.changedTouches[0].screenX
      touchstartY = event.changedTouches[0].screenY
    }, false)

    this.el.addEventListener('touchmove', event => {

      touchmoveX = event.changedTouches[0].screenX
      touchmoveY = event.changedTouches[0].screenY

      if (touchmoveX < (touchstartX - 40) || touchmoveX > (touchstartX + 40)) {
        this.disableScroll()
      }

    }, false)

    this.el.addEventListener('touchend', event => {
      touchendX = event.changedTouches[0].screenX
      touchendY = event.changedTouches[0].screenY


      let next = this.pagination.querySelector('li') ? this.pagination.querySelector('li.active').nextSibling : null;
      let prev = this.pagination.querySelector('li') ? this.pagination.querySelector('li.active').previousSibling : null;


      if (touchendX < (touchstartX - 40)) {
        if (next) {
          next.click()
        }
      }

      if (touchendX > (touchstartX + 40)) {
        if (prev) {
          prev.click()
        }
      }

      this.enableScroll()
    }, false)
  }

  play() {
    if (this.autoPlay) {
      this.autoPlayTimeout = setTimeout(() => {
        let next = this.pagination.querySelector('li') ? this.pagination.querySelector('li.active').nextSibling : null

        if (next) {
          next.click()
        } else {
          this.pagination.querySelector('li').click()
        }
      }, this.autoPlay)
    }
  }
}