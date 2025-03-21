/* 
*   Lightbox: Fetches image using REST API and displays it in a modal
*/

export default class Lightbox {

  constructor(args) {
    this.el = args.el
    this.closeText = this.el.dataset.close
    this.images = this.el.querySelectorAll('.img-wrapper')

    this.restUrl = window.location.origin + '/wp-json/wp/v2/media/'

    this.images.forEach(element => {
      element.addEventListener('click', ev => {
        const id = element.dataset.id
        this.getImageFromRestApi(id)
      })
    });
  }

  createModalElement(element) {
    this.modal = document.createElement('div')
    this.modal.classList.add('modal', 'grid', 'jc', 'jcc', 'ac', 'acc')

    this.closeBtn = document.createElement('button')
    this.closeBtn.classList.add('modal-close', 'btn')
    this.closeBtn.innerHTML = this.closeText

    this.modalBody = document.createElement('div')
    this.modalBody.classList.add('modal-body')
    this.modalBody.innerHTML = `<div class="img-wrapper"><img src="${element}" alt=""></div>`

    this.modal.appendChild(this.closeBtn)
    this.modal.appendChild(this.modalBody)

    document.body.appendChild(this.modal)

    this.closeBtn.addEventListener('click', ev => {
      this.closeModal()
    })

    this.modal.addEventListener('click', ev => {
      if (ev.target !== this.modalBody) {
        this.closeModal()
      }
    })
  }

  closeModal() {
    this.modal.remove()
  }

  getImageFromRestApi(id) {
    fetch(this.restUrl + id)
      .then(response => response.json())
      .then(data => {
        this.createModalElement(data.source_url)
      })
  }

}