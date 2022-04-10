import fetcher, { ApiSchemas } from '@/modules/shared/services/fetcher'
import { ApiResponse } from 'openapi-typescript-fetch'

export type Todo = ApiSchemas['Todo']

export default class TodoService {
  public todos: Todo | null = null

  public loadTodo(): Promise<ApiResponse<Todo[]>> {
    return fetcher
      .path('/api/todos')
      .method('get')
      .create()({})
      .then((response) => {
        this.todos = response.data
        return response
      })
  }

  public addTodo(todo: Todo): Promise<ApiResponse<Todo>> {
    return fetcher
      .path('/api/todos')
      .method('post')
      .create()(todo)
      .then((response) => {
        this.loadTodo()
        return response
      })
  }

  public removeTodo(id: Todo['id']): Promise<ApiResponse<unknown>> {
    return fetcher
      .path('/api/todos/{id}')
      .method('delete')
      .create()({ id })
      .then((response) => {
        this.loadTodo()
        return response
      })
  }
}
