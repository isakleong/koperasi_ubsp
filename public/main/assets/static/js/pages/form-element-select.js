let choices = document.querySelectorAll(".search")
let initChoice
for (let i = 0; i < choices.length; i++) {
  if (choices[i].classList.contains("multiple-remove")) {
    initChoice = new Choices(choices[i], {
      delimiter: ",",
      editItems: true,
      maxItemCount: -1,
      removeItemButton: true,
    })
  } else {
    initChoice = new Choices(choices[i])
  }
}
