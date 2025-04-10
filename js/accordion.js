class Accordion {
  constructor(selector, multiple = true) {
    this.accordion = document.querySelector(selector);
    this.multiple = multiple;
    this.bindEvents();
  }

  bindEvents() {
    this.accordion
      .querySelectorAll(".question-box .item-accordion")
      .forEach((elementQuestion) => {
        elementQuestion.addEventListener("click", () => {
          let item = elementQuestion.parentNode;
          this.validateMultiple(item);
          item.classList.toggle("active");
        });
      });
  }
  validateMultiple(selectedItem) {
    if (this.multiple) return;

    this.accordion.querySelectorAll(".question-box").forEach((item) => {
      if (selectedItem == item) return;
      item.classList.remove("active");
    });
  }
}

(function () {
  new Accordion(".items-accordion-01");
})();