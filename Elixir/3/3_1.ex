defmodule Toboggan do
  def route(vert) do
    file = File.read!("input.txt")
    |> String.split("\n")
    Enum.map(file, fn(x) -> [Enum.find_index(file, fn(y) -> y == x end), String.duplicate(x, 50)]end)
    |> Enum.filter(fn(list) -> Toboggan.pos?(list) == true end)
    |> length()
  end

  def pos?([key, value]) do
   String.slice(value, key*3..key*3) == "#"
  end
end
