function copyCode(codigo){
    navigator.clipboard.writeText(codigo)
    .then(() => {
        console.log("Text copied to clipboard...")
    })
        .catch(err => {
        console.log('Something went wrong', err);
    });
}
function copyLink(codigo){
    navigator.clipboard.writeText(codigo)
    .then(() => {
        console.log("Text copied to clipboard...")
    })
        .catch(err => {
        console.log('Something went wrong', err);
    });
}