defmodule Toboggan do
  def route(hor, vert) do
    file = File.read!("input.txt")
    |> String.split("\n")
    Enum.map(file, fn(x) -> [Enum.find_index(file, fn(y) -> y == x end), String.duplicate(x, 1000)]end)
    |> Enum.filter(fn(list) -> Toboggan.pos(list, hor ,vert) == true end)
    |> length()
  end

  def pos([key, value], hor ,vert) do
    require Integer
    case vert do
      2 -> String.slice(value, key*hor-2..key*hor-2) == "#" and Integer.is_odd(key)
      1 -> String.slice(value, key*hor..key*hor) == "#"
    end
  end

  def routes_multiply(range) do
  routes = Enum.map(range, fn(x) -> String.split(x, "-") |> Enum.map(fn(l) -> String.to_integer(l) end) end)
  Enum.map(routes, fn([x, y]) -> Toboggan.route(x, y) end)
  |> Math.multiply()
  end
end

defmodule Math do
  def multiply([first | rest]) do
    multiply(rest, first)
  end

  def multiply([first | rest], num) do
    multiply(rest, num*first)
  end

  def multiply([], num) do
    num
  end

end
