<?php $session = session() ?>

<?= $this->extend('_base/core') ?>

<?= $this->section('content') ?>

<div>
    <h5>Profil</h5>
    <p><?= $session->get('name'); ?>
</div>

<?= $this->endSection() ?>