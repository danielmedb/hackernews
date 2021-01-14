1. Clone repo

```
  git clone https://github.com/danielmedb/hackernews.git
```

2. Start the server

```
php artisan serve
```

3. 
```
Update absolute path in .env for the database. (db.sqlite)
```

## Code Review – Evelyn Fredin
1. Love the design, even though it is similar to the original Hacker News, this one makes me actually wanna spend some time here, checking the posts and reading the comments.
2. I spent some time thinking how replying to comments should work and I was very glad to see you did just that and answered my question so, I learned something new.
3. `web.php` I like how clean your Routes file looks, very well organised, unlike others I've seen (mine)
4. `app/Http/Controllers` It's very interesting and educational to see your Controllers and all the methods you used, some I recognise, some I don't.
5. I see you made good use of Laravel Policies. It was one of the features of Laravel that impressed me the most. I would just have made one for each Model to keep the consistency but since it doesn't take much logic to write them I guess it's perfectly fine.
6. Cool to see you used the String Helpers. So smooth to write proper language around plurals and singulars, for example.
7. I tried the Recover Password feature and didn't seem to work for me
8. `UserProfileController.php` I used the `storage()` method to handle uploading the avatars and then moved them to the Public directory with help of `Symlink` I see you did it other way but as a new Laravel dev, I have no idea what is the best way go to.
9. I would have moved the databse file inside the database directory
10. Overall I think you did great both with the logic and the look & feel, specially if this was your first ever Laravel Project. Congrats!

## Tested By
###  Martin

