<?php $session = session() ?>

<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<div>
    <h5>Profil</h5>
    <p><?= $session->get('name'); ?></p>
</div>

<?= $this->endSection() ?>