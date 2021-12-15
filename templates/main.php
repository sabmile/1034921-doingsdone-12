<section class="content__side">
    <h2 class="content__side-heading">Проекты</h2>

    <nav class="main-navigation">
        <ul class="main-navigation__list">
            <?php foreach($projects as $project) : ?>
                <li class="main-navigation__list-item <?php if ($project['selected']): ?>main-navigation__list-item--active<?php endif; ?>">
                    <a class="main-navigation__list-item-link" href="?project_id=<?= $project['id'] ?>"><?= htmlspecialchars($project['name']); ?></a>
                    <span class="main-navigation__list-item-count"><?= htmlspecialchars(countTasks($tasksAll, $project['name'])); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <a class="button button--transparent button--plus content__side-button"
       href="pages/form-project.html" target="project_add">Добавить проект</a>
</section>

<main class="content__main">
    <h2 class="content__main-heading">Список задач</h2>

    <form class="search-form" action="index.php" method="post" autocomplete="off">
        <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

        <input class="search-form__submit" type="submit" name="" value="Искать">
    </form>

    <div class="tasks-controls">
        <nav class="tasks-switch">
            <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
            <a href="/" class="tasks-switch__item">Повестка дня</a>
            <a href="/" class="tasks-switch__item">Завтра</a>
            <a href="/" class="tasks-switch__item">Просроченные</a>
        </nav>

        <label class="checkbox">
            <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
            <input class="checkbox__input visually-hidden show_completed" type="checkbox" <?php if ($show_complete_tasks === 1): ?> checked <?php endif; ?>>
            <span class="checkbox__text">Показывать выполненные</span>
        </label>
    </div>

    <table class="tasks">
        <?php foreach($tasks as $task) :
            if ($show_complete_tasks === 0 && $task['isDone']) :
                continue;
            endif; ?>
            <!-- отображение строки с классом task--completed при условии исполнения задания -->
            <!-- отображение строки с классом task--important при условии что дата не null и менее 24 часов до задания -->
            <tr class="tasks__item task <?php if ($task['isDone']): ?>task--completed<?php endif; ?><?php var_dump(checkHours($hoursBeforeTask, $task['date'])); if ((is_string($task['date'])) && (checkHours($hoursBeforeTask, $task['date']))): ?> task--important<?php endif; ?>">
                <td class="task__select">
                    <label class="checkbox task__checkbox">
                        <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1">
                        <span class="checkbox__text "><?= htmlspecialchars($task['name']); ?></span>
                    </label>
                </td>
                <td><a href="/uploads/<?= htmlspecialchars($task['file_name']); ?>"><?= htmlspecialchars($task['file_name']); ?></a></td>
                <td class="task__date"><?= htmlspecialchars($task['date']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>
