<template>
  <div class="">
    <div v-if="todoService.todos">
      <div v-for="todo in todoService.todos" :key="todo.id">
        <span class="mr-5">{{ todo }}</span>
        <button class="app-btn" @click="() => todoService.removeTodo(todo.id)">Remmove</button>
      </div>
      <div class="mt-5 w-1/2">
        <input v-model="currentTodo" type="text" class="app-input"/>
        <button class="app-btn" @click="() => todoService.addTodo({content: currentTodo})">Ajouter Todo</button>
      </div>
    </div>
    <div v-else>
      <LoaderComponent/>
    </div>
  </div>
</template>

<script setup lang="ts">
import {useStore} from '@/store'
import TodoService from '@/modules/todo/services/TodoService'
import LoaderComponent from '@/modules/shared/components/LoaderComponent.vue'

const currentTodo = ''
const todoService: TodoService = useStore().state.todoService
todoService.loadTodo()

</script>
