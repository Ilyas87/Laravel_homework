var likeButton = document.getElementById('toggle-like');
var isLike = likeButton.dataset.is === 'true';

const setLikeButtonText = () => {
    var image = document.getElementById('image');
    let likeImage = "/storage/buttons/like.png";
    let dislikeImage = "/storage/buttons/dislike.png";

    image.src = isLike ? likeImage : dislikeImage;
}

document.addEventListener('DOMContentLoaded', () => {
    setLikeButtonText();

    likeButton.addEventListener('click', () => {
        axios.post(likeButton.dataset.url)
            .then((response) => {
                if (response.data.status === 'ok') {
                    isLike = !isLike;
                    likeButton.dataset.is = isLike ? 'true' : 'false';
                }
            })
            .finally(() => {
                setLikeButtonText();
            })
    });
});


