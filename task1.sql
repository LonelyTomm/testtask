/** QUERY 1 **/
SELECT users.* FROM users
JOIN users invited_by ON invited_by.id = users.invited_by_user_id
WHERE users.posts_qty > invited_by.posts_qty;


/** QUERY 2 **/
SELECT * FROM users
JOIN (
    SELECT users.group_id, MAX(users.posts_qty) max_posts_qty FROM users
    GROUP BY users.group_id
) group_max_post_qty ON group_max_post_qty.group_id = users.group_id 
    AND group_max_post_qty.max_posts_qty = users.posts_qty;


/** QUERY 3 **/
SELECT groups.* FROM groups
JOIN (
    SELECT users.group_id FROM users
    GROUP BY users.group_id
    HAVING COUNT(users.id) > 10000
) qual_group ON qual_group.group_id = groups.id;


/** QUERY 4 **/
SELECT users.* FROM users
JOIN users invited_by ON invited_by.id = users.invited_by_user_id
WHERE users.group_id != invited_by.group_id;


/** QUERY 5 **/
SELECT groups.* FROM groups
JOIN (
    SELECT groups.id FROM groups
    JOIN users ON users.group_id = groups.id
    JOIN (SELECT MAX(sum_posts_qty.posts_qty) posts_qty FROM 
        (SELECT SUM(users.posts_qty) posts_qty FROM users
        GROUP BY users.group_id) sum_posts_qty) max_posts_qty ON 1 = 1
    GROUP BY groups.id, max_posts_qty.posts_qty
    HAVING SUM(users.posts_qty) = max_posts_qty.posts_qty
) qual_groups on qual_groups.id = groups.id;