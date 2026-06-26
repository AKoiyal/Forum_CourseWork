<?php require_once __DIR__ . '/../includes/header.html.php'; ?>
<?php require_once __DIR__ . '/../includes/navbar.html.php'; ?>

<main class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Read Questions</h1>
    <a class="btn btn-success" href="create.php">Add New Question</a>
  </div>

  <?php if (empty($posts)): ?>
    <div class="alert alert-info">No questions found.</div>
  <?php else: ?>
    <?php foreach ($posts as $post): ?>
      <div class="card mb-4 shadow-sm">
        <div class="card-body">
          <h4 class="card-title mb-2"><?php echo htmlspecialchars($post['title']); ?></h4>
          <p class="text-muted mb-2">
            Module: <?php echo htmlspecialchars($post['module_code'] . ' - ' . $post['module_name']); ?>
          </p>
          <p class="mb-2">Posted by: <strong><?php echo htmlspecialchars($post['username']); ?></strong></p>
          <p class="mb-3"><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
          <small class="text-muted">Posted on: <?php echo htmlspecialchars($post['created_at']); ?></small>

          <?php if (!empty($post['image_path'])): ?>
            <div class="mt-3">
              <img src="../uploads/<?php echo htmlspecialchars($post['image_path']); ?>" alt="Question image" class="img-fluid rounded border">
            </div>
          <?php endif; ?>

          <div class="mt-3">
            <a class="btn btn-primary btn-sm" href="show.php?id=<?php echo (int)$post['post_id']; ?>">View</a>
            <a class="btn btn-warning btn-sm" href="edit.php?id=<?php echo (int)$post['post_id']; ?>">Edit</a>
            <a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo (int)$post['post_id']; ?>">Delete</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</main>

<?php require_once __DIR__ . '/../includes/footer.html.php'; ?>