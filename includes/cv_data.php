<?php
require_once __DIR__ . '/../config/database.php';

function cv_get_all(): array
{
    $db = db();

    return [
        'profile'        => $db->query('SELECT * FROM profile LIMIT 1')->fetch() ?: [],
        'stats'          => $db->query('SELECT * FROM stats ORDER BY sort_order, id')->fetchAll(),
        'skills'         => $db->query('SELECT * FROM skills ORDER BY sort_order, id')->fetchAll(),
        'tools'          => $db->query('SELECT * FROM tools ORDER BY sort_order, id')->fetchAll(),
        'soft_skills'    => $db->query('SELECT * FROM soft_skills ORDER BY sort_order, id')->fetchAll(),
        'experiences'    => $db->query('SELECT * FROM experiences ORDER BY sort_order, id')->fetchAll(),
        'education'      => $db->query('SELECT * FROM education ORDER BY sort_order, id')->fetchAll(),
        'certifications' => $db->query('SELECT * FROM certifications ORDER BY sort_order, id')->fetchAll(),
        'projects'       => $db->query('SELECT * FROM projects ORDER BY sort_order, id')->fetchAll(),
    ];
}

function cv_save_profile(array $d): void
{
    $db = db();
    $row = $db->query('SELECT id FROM profile LIMIT 1')->fetch();

    if ($row) {
        $stmt = $db->prepare('UPDATE profile SET
            full_name=?, job_title=?, headline=?, about_lead=?, about_body=?,
            email=?, phone=?, location=?, linkedin=?, github=?, whatsapp=?, photo_url=?,
            status_badge=?, contact_title=?, contact_text=?
            WHERE id=?');
        $params = [
            $d['full_name'], $d['job_title'], $d['headline'], $d['about_lead'], $d['about_body'],
            $d['email'], $d['phone'], $d['location'], $d['linkedin'], $d['github'], $d['whatsapp'], $d['photo_url'],
            $d['status_badge'], $d['contact_title'], $d['contact_text'],
            $row['id'],
        ];
    } else {
        $stmt = $db->prepare('INSERT INTO profile (
            full_name, job_title, headline, about_lead, about_body,
            email, phone, location, linkedin, github, whatsapp, photo_url,
            status_badge, contact_title, contact_text
        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $params = [
            $d['full_name'], $d['job_title'], $d['headline'], $d['about_lead'], $d['about_body'],
            $d['email'], $d['phone'], $d['location'], $d['linkedin'], $d['github'], $d['whatsapp'], $d['photo_url'],
            $d['status_badge'], $d['contact_title'], $d['contact_text'],
        ];
    }

    $stmt->execute($params);
}

function cv_replace_table(string $table, array $rows, array $columns): void
{
    $db = db();
    $db->exec("DELETE FROM {$table}");

    if (empty($rows)) {
        return;
    }

    $placeholders = implode(',', array_fill(0, count($columns), '?'));
    $colList = implode(',', $columns);
    $stmt = $db->prepare("INSERT INTO {$table} ({$colList}) VALUES ({$placeholders})");

    foreach ($rows as $row) {
        $values = [];
        foreach ($columns as $col) {
            $values[] = $row[$col] ?? '';
        }
        $stmt->execute($values);
    }
}

function cv_save_stats(array $rows): void
{
    cv_replace_table('stats', $rows, ['label', 'value', 'icon', 'color', 'sort_order']);
}

function cv_save_skills(array $rows): void
{
    cv_replace_table('skills', $rows, ['name', 'percent', 'color', 'sort_order']);
}

function cv_save_tools(array $rows): void
{
    cv_replace_table('tools', $rows, ['name', 'sort_order']);
}

function cv_save_soft_skills(array $rows): void
{
    cv_replace_table('soft_skills', $rows, ['name', 'sort_order']);
}

function cv_save_experiences(array $rows): void
{
    cv_replace_table('experiences', $rows, ['period', 'title', 'description', 'icon', 'color', 'sort_order']);
}

function cv_save_education(array $rows): void
{
    cv_replace_table('education', $rows, ['degree', 'institution', 'detail', 'description', 'sort_order']);
}

function cv_save_certifications(array $rows): void
{
    cv_replace_table('certifications', $rows, ['title', 'issuer', 'sort_order']);
}

function cv_save_projects(array $rows): void
{
    cv_replace_table('projects', $rows, ['title', 'category', 'badge_color', 'description', 'repo_url', 'demo_url', 'sort_order']);
}

function cv_external_url(string $url, string $prefix = 'https://'): string
{
    $url = trim($url);
    if ($url === '' || $url === '#') {
        return '#';
    }
    if (preg_match('/^https?:\/\//i', $url)) {
        return $url;
    }
    return $prefix . ltrim($url, '/');
}

function cv_mailto(string $email): string
{
    return 'mailto:' . trim($email);
}

function cv_whatsapp_url(string $phone): string
{
    $n = preg_replace('/\D+/', '', $phone);
    if (strlen($n) > 0 && $n[0] === '0') {
        $n = '62' . substr($n, 1);
    }
    return 'https://wa.me/' . $n;
}
