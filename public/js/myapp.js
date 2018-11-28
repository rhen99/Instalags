// $('.like').on('click', function(event) {
// 	const postId = event.target.parentNode.parentNode.parentNode.dataset['postid'];

// 	const like = event.target;

// 	$.ajax({
// 		method: 'POST',
// 		url: urlLike,
// 		data: {
// 			liked: like,
// 			postId: postId,
// 			_token: token
// 		}
// 	}).done(function() {});
// });

$('.like').on('click', function(e) {
	e.preventDefault();
	const postId = event.target.parentNode.parentNode.parentNode.dataset['postid'];

	const like = true;

	$.ajax({
		method: 'POST',
		url: urlLike,
		data: {
			liked: like,
			postId: postId,
			_token: token
		}
	}).done(function() {
		let likeTxt = e.target.innerHTML;
		let likeCount = parseInt($('.like-count').text());

		if (likeTxt === 'Like') {
			e.target.innerHTML = 'Unlike';
			likeCount++;
			$('.like-count').html(likeCount);
		} else {
			e.target.innerHTML = 'Like';
			likeCount--;
			$('.like-count').html(likeCount);
		}
	});
});
$('#follow-btn').on('click', function(e) {
	e.preventDefault();
	const userName = parseInt(document.querySelector('.usersname').dataset['userid']);
	const follow = true;

	$.ajax({
		type: 'POST',
		url: urlFollow,
		data: {
			isFollowing: follow,
			userId: userName,
			_token: token
		}
	}).done(function() {
		let followTxt = e.target.innerHTML;
		let followerCount = parseInt(document.querySelector('.follower').innerHTML);
		let followerTxt = document.querySelector('.follower');

		if (followTxt === 'Follow') {
			e.target.innerHTML = 'Following';
			followerCount++;
			followerTxt.innerHTML = followerCount;
		} else {
			e.target.innerHTML = 'Follow';
			followerCount--;
			followerTxt.innerHTML = followerCount;
		}
	});
});
