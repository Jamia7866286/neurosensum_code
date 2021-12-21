const form = getElement('getNpsForm');
form.addEventListener('submit', ($event) => {
    $event.preventDefault();
    signUp();
});
async function signUp() {
    const email = getElement('email').value;
    const name = getElement('name').value;
    const password = getElement('pwd').value;
    const user = {
        name: name,
        email: email,
        password: password,
        source: 'NPSLANDINGPAGE'
    }
    try{
        encodedUrl = encodeURIComponent(btoa(JSON.stringify(user)));        
        window.location.href = `${environment.portalUrl}/register?token=${encodedUrl}`+ '&source='+ user.source + '&type=selfRegisterd';
    } catch(e) {
        // something went wrong
        alert(e);
    }
}
function getElement(id) {
    return document.getElementById(id);
}