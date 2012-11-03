    $binary_sources = array();
    foreach ($changes as $change) {
      if (!$this->isGitBinaryChange($change)) {
        continue;
      }

      $type = $change->getType();
      if ($type == ArcanistDiffChangeType::TYPE_MOVE_AWAY ||
          $type == ArcanistDiffChangeType::TYPE_COPY_AWAY ||
          $type == ArcanistDiffChangeType::TYPE_MULTICOPY) {
        foreach ($change->getAwayPaths() as $path) {
          $binary_sources[$path] = $change;
        }
      }
    }

        $old_binary = idx($binary_sources, $this->getCurrentPath($change));
        $change_body = $this->buildBinaryChange($change, $old_binary);
          $type == ArcanistDiffChangeType::TYPE_COPY_AWAY ||
          $type == ArcanistDiffChangeType::TYPE_CHANGE) {
  private function buildBinaryChange(ArcanistDiffChange $change, $old_binary) {
    // In Git, when we write out a binary file move or copy, we need the
    // original binary for the source and the current binary for the
    // destination.
    if ($old_binary) {
      if ($old_binary->getOriginalFileData() !== null) {
        $old_data = $old_binary->getOriginalFileData();
        $old_phid = null;
      } else {
        $old_data = null;
        $old_binary->getMetadata('old:binary-phid');
      }
    } else {
      $old_phid = $change->getMetadata('old:binary-phid');
    }

    if ($old_data === null && $old_phid) {
    $new_phid = $change->getMetadata('new:binary-phid');
