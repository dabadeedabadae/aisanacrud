<!DOCTYPE html>
<html lang="<?= Yii::app()->language ?>">
<head>
	<title><?= CHtml::encode($this->pageTitle) ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php 
	Yii::app()->clientScript->registerCssFile(
		'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css',
		'screen',
		CClientScript::POS_HEAD
	);
	
	Yii::app()->clientScript->registerCssFile(
		'https://unpkg.com/aos@2.3.4/dist/aos.css',
		'screen',
		CClientScript::POS_HEAD
	);
	
	Yii::app()->clientScript->registerCssFile(
		'https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css',
		'screen',
		CClientScript::POS_HEAD
	);
	
	Yii::app()->clientScript->registerCssFile(
		Yii::app()->baseUrl . '/css/main.css?v=minimal-admin-2025-01-15',
		'screen',
		CClientScript::POS_HEAD
	);
	?>
	<?php
	
	Yii::app()->clientScript->registerScriptFile(
		'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js',
		CClientScript::POS_END
	);
	
	Yii::app()->clientScript->registerScriptFile(
		'https://unpkg.com/aos@2.3.4/dist/aos.js',
		CClientScript::POS_END
	);
	
	Yii::app()->clientScript->registerScript(
		'aos-init',
		"AOS.init({ once: true, duration: 600 });",
		CClientScript::POS_READY
	);
	
	Yii::app()->clientScript->registerScriptFile(
		Yii::app()->baseUrl . '/js/main.js',
		CClientScript::POS_END
	);
	?>
</head>

<?php
$locales = [
	['code' => 'ru', 'name' => 'Русский', 'flag' => '🇷🇺'],
	['code' => 'kz', 'name' => 'Қазақ', 'flag' => '🇰🇿'],
	['code' => 'en', 'name' => 'English', 'flag' => '🇬🇧'],
];

$current = Yii::app()->language;
$currentLocale = null;
foreach ($locales as $loc) {
	if ($loc['code'] === $current) {
		$currentLocale = $loc;
		break;
	}
}
if (!$currentLocale) {
	$currentLocale = $locales[0];
}
?>

<body>
	<header class="nav">
		<div class="brand">
			<a href="<?= Yii::app()->createUrl('aisana/index') ?>">
				<img src="<?= Yii::app()->baseUrl ?>/uploads/logo.png" alt="Logo" class="logo">
			</a>
		</div>
		
		<nav class="links">
			<a href="https://ku.edu.kz/aisana/indexNew">
				<img src="<?= Yii::app()->baseUrl ?>/components/icons/home.svg" alt="Главная" class="icon">
				<?= Yii::t('labels', 'Главная') ?>
			</a>
			<a href="https://ku.edu.kz/aisana/indexNew#ai-agents-section">
				<img src="<?= Yii::app()->baseUrl ?>/components/icons/ai-agents.svg" alt="AI Агенты" class="icon">
				<?= Yii::t('labels', 'AI Агенты') ?>
			</a>
			<a href="https://ku.edu.kz/aisana/indexNew#about-program-section">
				<img src="<?= Yii::app()->baseUrl ?>/components/icons/question.svg" alt="О программе" class="icon">
				<?= Yii::t('labels', 'О программе') ?>
			</a>
			<a href="<?= Yii::app()->createUrl('aisana/news') ?>">
				<img src="<?= Yii::app()->baseUrl ?>/components/icons/news.svg" alt="Новости" class="icon">
				<?= Yii::t('labels', 'Новости') ?>
			</a>
			<a href="<?= Yii::app()->createUrl('aisana/courses') ?>">
				<img src="<?= Yii::app()->baseUrl ?>/components/icons/courses.svg" alt="Курсы" class="icon">
				<?= Yii::t('labels', 'Курсы') ?>
			</a>
			<a href="<?= Yii::app()->createUrl('aisana/projects') ?>">
				<img src="<?= Yii::app()->baseUrl ?>/components/icons/projects.svg" alt="Другие проекты" class="icon">
				<?= Yii::t('labels', 'Другие проекты') ?>
			</a>
			<a href="https://ku.edu.kz/aisana/indexNew#contacts-section">
				<img src="<?= Yii::app()->baseUrl ?>/components/icons/contacts.svg" alt="Контакты" class="icon">
				<?= Yii::t('labels', 'Контакты') ?>
			</a>
		</nav>
		
		<div class="language-switcher-wrapper">
			<div class="language-switcher">
				<button id="lang-btn">
					<span id="lang-flag"><?= $currentLocale['flag'] ?></span>
					<span id="lang-arrow">▼</span>
				</button>
				<div id="lang-menu">
					<ul>
						<?php foreach ($locales as $loc): ?>
							<li data-code="<?= $loc['code'] ?>">
								<?= $loc['flag'] . ' ' . $loc['name'] ?>
							</li>
						<?php endforeach ?>
					</ul>
				</div>
			</div>
		</div>
	</header>
	
	<main>
		<?= $content ?>
	</main>
	
	<footer class="main-footer">
		<div class="footer-content">
			<p class="footer-text"><?= Yii::t('labels', '© 2025 AISana, Kozybayev University. Разработка интеллектуальных решений для образования и города.') ?></p>
		</div>
	</footer>
</body>
</html>
