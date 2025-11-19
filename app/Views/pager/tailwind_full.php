<?php

/**
 * Tailwind Pagination Template for CodeIgniter 4
 */
?>

<?php if ($pager->hasPrevious() || $pager->hasNext()): ?>
    <nav class="flex items-center space-x-1" aria-label="Pagination">

        <!-- Previous Button -->
        <?php if ($pager->hasPrevious()): ?>
            <a href="<?= $pager->getPreviousPage() ?>"
                class="px-3 py-1.5 bg-white border rounded-md hover:bg-gray-50 text-gray-700 text-sm flex items-center gap-1">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Prev
            </a>
        <?php else: ?>
            <span class="px-3 py-1.5 bg-gray-100 border rounded-md text-gray-400 text-sm flex items-center gap-1 cursor-not-allowed">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Prev
            </span>
        <?php endif; ?>

        <!-- Number buttons -->
        <?php foreach ($pager->links() as $link): ?>
            <?php if ($link['active']): ?>
                <span class="px-3 py-1.5 bg-blue-600 border border-blue-600 text-white rounded-md text-sm">
                    <?= $link['title'] ?>
                </span>
            <?php else: ?>
                <a href="<?= $link['uri'] ?>"
                    class="px-3 py-1.5 bg-white border rounded-md hover:bg-gray-50 text-gray-700 text-sm">
                    <?= $link['title'] ?>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>

        <!-- Next Button -->
        <?php if ($pager->hasNext()): ?>
            <a href="<?= $pager->getNextPage() ?>"
                class="px-3 py-1.5 bg-white border rounded-md hover:bg-gray-50 text-gray-700 text-sm flex items-center gap-1">
                Next
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        <?php else: ?>
            <span class="px-3 py-1.5 bg-gray-100 border rounded-md text-gray-400 text-sm flex items-center gap-1 cursor-not-allowed">
                Next
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </span>
        <?php endif; ?>

    </nav>
<?php endif; ?>