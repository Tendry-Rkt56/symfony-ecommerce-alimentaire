const formProfil = document.getElementById('form-profil')
const imageFile = document.getElementById('imageFile')

alert('Bonjour le monde')

formProfil.addEventListener('submit', (e) => {
     if (imageFile.value == null || imageFile.value == '') e.preventDefault()
})