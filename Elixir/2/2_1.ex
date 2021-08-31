defmodule Passwords do
  def validate do
      File.read!("list.txt")
    |> String.split("\n")
    |> Enum.map(fn(x) -> String.split(x, ":") end)
    |> Enum.filter(fn([x, y]) ->  Passwords.policy_check?([x, y]) == true end)
    |> length()
  end

  def policy_check?([pol, pass]) do
    [num, char] = String.split(pol, " ")
    String.split(pass, char)
    |> Enum.drop(1)
    |> length()
    |> Passwords.range?(String.split(num, "-"))
    end

  def range?(length ,[min, max]) do
    length <= String.to_integer(max) and length >= String.to_integer(min)
  end
end
