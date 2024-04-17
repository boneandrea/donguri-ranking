window.addEventListener('input', (e) => {
  const self = e.srcElement
  if (!self.classList.contains('score')) return

  const span = self.parentNode.parentNode.querySelector('.changed')
  if (self.value === '') span.classList.add('hide')
  else span.classList.remove('hide')
})

document.querySelector('button').addEventListener('click', () => {
  if (confirm('reset??')) {
    window.location.reload()
  }
})

document.querySelector('form').addEventListener('submit', (e) => {
  const gross = qaa('input[type=number]')
  let noinput = true
  gross.forEach((e) => {
    if (e.value !== '') noinput = false
  })
  if (noinput) {
    e.preventDefault()
    alert('input score')
    return
  }

  if (!confirm('登録OK?')) {
    e.preventDefault()
  }
})
if(0)$(document).ready(function() {
    $.ajax({
        url: "https://script.google.com/macros/s/AKfycbxftKzsOgfxqSx35sOcqqrgWl-gg9g5t6bkUfxyEfQfOUeTO4bsk3h4VVmiwjRSJVee/exec",
        dataType: 'json',
        success: function(data) {
            console.log(data)
        }
    })
})
