const select = document.getElementById('select')
const options = document.querySelectorAll('.options')
const url = window.location.href

if (select) {
    if (options.length !== 0) {
        if (url.includes('/admin')) {
            options[1].setAttribute("selected", "selected")
        }
        else{
            options[2].setAttribute('selected', 'selected')
        }
    }
    select.addEventListener('change', () => {
         if (select.value == 1) {
              window.location.href = '/admin/articles'
         }
         else if (select.value == 2) {
              window.location.href = '/articles'
         }
    })
}