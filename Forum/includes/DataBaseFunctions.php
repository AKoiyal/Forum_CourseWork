<?php
function query($pdo, $sql, $parameters = [])
{
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}

function totalPosts($pdo)
{
    $sql = 'SELECT COUNT(*) FROM posts';
    $result = query($pdo, $sql);
    $row = $result->fetch();
    return $row[0];
}
