var favoriteButton = document.getElementById('toggle-favorite');
var isFavorite = favoriteButton.dataset.is === 'true';

const setFavoriteButtonText = () => {
    let favoriteText = favoriteButton.dataset.favorite;
    let unfavoriteText = favoriteButton.dataset.unfavorite;

    favoriteButton.innerText = isFavorite ? unfavoriteText : favoriteText;
}

document.addEventListener('DOMContentLoaded', () => {
    setFavoriteButtonText();

    favoriteButton.addEventListener('click', () => {
        axios.post(favoriteButton.dataset.url)
            .then((response) => {
                if (response.data.status === 'ok') {
                    isFavorite = !isFavorite;
                    favoriteButton.dataset.is = isFavorite ? 'true' : 'false';
                }
            })
            .finally(() => {
                setFavoriteButtonText();
            })
    });
});
