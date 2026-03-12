<?php $this->load->view('admin/inc/header') ?>
<div class="container">
    <h3>Edit Menu: <?= htmlspecialchars($menu->menu_name) ?> (<?= htmlspecialchars($menu->label) ?>)</h3>
    <?php if ($this->session->flashdata('success_msg')) { ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success_msg') ?></div>
    <?php } ?>
    <?php if ($this->session->flashdata('error_msg')) { ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error_msg') ?></div>
    <?php } ?>

    <div class="row">
        <div class="col-md-6">
            <h4>Add Menu Item</h4>
            <form method="post" action="<?= base_url('admin/menu_item_save') ?>">
                <?php if ($this->config->item('csrf_protection')): ?>
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
                <?php endif; ?>
                <input type="hidden" name="menu_id" value="<?= $menu->id ?>" />
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" />
                </div>
                <div class="form-group">
                    <label>URL</label>
                    <input type="text" name="url" class="form-control" placeholder="/about or https://..." />
                </div>
                <div class="form-group">
                    <label>Parent Item (optional)</label>
                    <select name="parent_id" class="form-control">
                        <option value="0">-- none --</option>
                        <?php foreach ($items as $it) { ?>
                            <option value="<?= $it->id ?>"><?= htmlspecialchars($it->title) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Sort order</label>
                    <input type="number" name="sort_order" class="form-control" value="0" />
                </div>
                <button class="btn btn-primary">Add Item</button>
            </form>
        </div>
        <div class="col-md-6">
            <h4>Menu Items (drag to reorder / nest)</h4>
            <p>Drag items to change order or make them children of other items. Click "Save Order" to persist.</p>
            <div style="margin-bottom:8px">
                <button id="save-order" class="btn btn-sm btn-primary">Save Order</button>
                <button id="undo-order" class="btn btn-sm btn-default" style="display:none;margin-left:8px;">Undo</button>
            </div>
            <ol id="menu-items-list" class="nested-sortable" style="margin-top:10px;">
                <?php
                // Build tree from flat items
                $tree = array();
                $lookup = array();
                foreach ($items as $it) {
                    $lookup[$it->id] = (array)$it + ['children' => []];
                }
                foreach ($lookup as $id => &$node) {
                    $pid = intval($node['parent_id']);
                    if ($pid && isset($lookup[$pid])) {
                        $lookup[$pid]['children'][] = &$node;
                    } else {
                        $tree[] = &$node;
                    }
                }
                function render_node($node)
                {
                    $html = '<li id="menuItem_' . $node['id'] . '" data-id="' . $node['id'] . '">';
                    $html .= '<div class="menu-item-row"><span class="drag-handle" style="cursor:move;margin-right:8px;">☰</span> <strong>' . htmlspecialchars($node['title']) . '</strong> <small>' . htmlspecialchars($node['url']) . '</small> <span style="float:right"><a href="' . base_url('admin/remove_menu_item/' . $node['id']) . '" onclick="return confirm(\'Remove item?\')">Delete</a></span></div>';
                    if (!empty($node['children'])) {
                        $html .= '<ol>';
                        foreach ($node['children'] as $c) $html .= render_node($c);
                        $html .= '</ol>';
                    }
                    $html .= '</li>';
                    return $html;
                }
                foreach ($tree as $n) {
                    echo render_node($n);
                }
                ?>
            </ol>
        </div>
    </div>
</div>

<?php $this->load->view('admin/inc/footer') ?>

<script>
    // Use nestedSortable (requires jQuery UI and plugin)
    ;
    (function() {
        // include jQuery UI and nestedSortable from CDN if not already present
        function loadScript(src, cb) {
            var s = document.createElement('script');
            s.src = src;
            s.onload = cb;
            document.head.appendChild(s);
        }
        var initialMenuHtml = null;

        function initNested() {
            if (!jQuery().nestedSortable) {
                console.error('nestedSortable not available');
                return;
            }
            jQuery('#menu-items-list').nestedSortable({
                handle: 'div',
                items: 'li',
                toleranceElement: '> div',
                maxLevels: 5,
                protectRoot: false,
                forcePlaceholderSize: true,
                placeholder: 'ns-placeholder',
                stop: function() {
                    jQuery('#undo-order').show();
                }
            });

            // capture an HTML snapshot for undo
            if (!initialMenuHtml) initialMenuHtml = jQuery('#menu-items-list').html();

            document.getElementById('save-order').addEventListener('click', function() {
                var serialized = jQuery('#menu-items-list').nestedSortable('toArray', {
                    startDepthCount: 0
                });
                // serialized is array of items with id, parent_id, depth, left, right
                var payload = JSON.stringify(serialized.map(function(it) {
                    return {
                        id: it.item_id,
                        parent_id: it.parent_id
                    };
                }));
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '<?= base_url('admin/save_menu_order/' . $menu->id) ?>', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status == 200) {
                        alert('Order saved');
                        location.reload();
                    } else {
                        alert('Error saving order');
                    }
                };
                xhr.send('order=' + encodeURIComponent(payload));
            }, false);
            document.getElementById('undo-order').addEventListener('click', function() {
                if (!initialMenuHtml) return; // nothing to undo
                jQuery('#menu-items-list').html(initialMenuHtml);
                // re-init nested sortable after replacing HTML
                initNested();
                jQuery('#undo-order').hide();
            }, false);
        }
        // load local vendor first (if present), fallback to CDN
        var localUi = '<?= base_url('assets/js/vendor/jquery-ui.min.js') ?>';
        var localNested = '<?= base_url('assets/js/vendor/jquery.mjs.nestedSortable.min.js') ?>';

        function tryLocalThenCdn() {
            // try loading local jQuery UI
            var s1 = document.createElement('script');
            s1.src = localUi;
            s1.onload = function() {
                var s2 = document.createElement('script');
                s2.src = localNested;
                s2.onload = initNested;
                s2.onerror = function() {
                    // load CDN nestedSortable if local missing
                    loadScript('https://cdnjs.cloudflare.com/ajax/libs/jquery.mjs.nestedSortable/2.1.0/jquery.mjs.nestedSortable.min.js', initNested);
                };
                document.head.appendChild(s2);
            };
            s1.onerror = function() {
                // local jQuery UI missing — fall back to CDN
                loadScript('https://code.jquery.com/ui/1.12.1/jquery-ui.min.js', function() {
                    loadScript('https://cdnjs.cloudflare.com/ajax/libs/jquery.mjs.nestedSortable/2.1.0/jquery.mjs.nestedSortable.min.js', initNested);
                });
            };
            document.head.appendChild(s1);
        }
        // If nestedSortable or jQuery UI already present, init directly
        if (typeof jQuery.ui !== 'undefined' && typeof jQuery().nestedSortable !== 'undefined') {
            initNested();
        } else {
            tryLocalThenCdn();
        }
    })();
</script>