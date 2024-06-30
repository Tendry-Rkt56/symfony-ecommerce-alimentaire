const formProfil = document.getElementById('form-profil')
const imageFile = document.getElementById('imageFile')


formProfil.addEventListener('submit', (e) => {
     if (imageFile.value == null || imageFile.value == '') e.preventDefault()
})