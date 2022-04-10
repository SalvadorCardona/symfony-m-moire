import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import UserPage from '@/modules/user/pages/UserPage.vue'
import HomePage from '@/modules/home/pages/HomePage.vue'
import TodoPage from '@/modules/todo/pages/TodoPage.vue'
import VisualEditorPage from '@/modules/visual-editor/pages/VisualEditorPage.vue'

enum MainPageList {
  HOME_PAGE = 'home-page',
  USER_PAGE = 'user-page',
  TODO_PAGE = 'todo-page',
  VISUAL_EDITOR = 'visual-editor',
}

export const PageList = { ...MainPageList }

const routes: RouteRecordRaw[] = [
  {
    path: '/front',
    component: HomePage,
    name: MainPageList.HOME_PAGE,
    children: [
      {
        path: 'user',
        component: UserPage,
        name: MainPageList.USER_PAGE,
      },
      {
        path: 'todo',
        component: TodoPage,
        name: MainPageList.TODO_PAGE,
      },
      {
        path: 'visual-editor',
        component: VisualEditorPage,
        name: MainPageList.VISUAL_EDITOR,
      },
    ],
  },
]

const router = createRouter({
  history: createWebHistory(),
  linkActiveClass: 'current-route',
  routes,
})

export default router
